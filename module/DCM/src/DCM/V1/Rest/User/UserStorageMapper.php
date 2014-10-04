<?php
namespace DCM\V1\Rest\User;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class UserStorageMapper
{
	/** @var Adapter $db */
	protected $db;

	/** @var string */
	protected $htpasswd_file;

	/**
	 * @param Adapter $db
	 * @param string $htpasswd_file
	 */
	public function __construct($db, $htpasswd_file)
	{
		$this->db            = $db;
		$this->htpasswd_file = $htpasswd_file;
	}

	/**
	 * @param string $sql
	 * @param array $params
	 * @return array
	 * @throws \Exception
	 */
	protected function sqlSelect($sql, $params)
	{
		$stmt   = $this->db->createStatement($sql, new ParameterContainer($params));
		$result = $stmt->execute();
		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);
			$result = array();
			while ($ret = $resultSet->current()) {
				$result[] = (array)$ret;
				$resultSet->next();
			}
			return $result;
		} else {
			throw new \Exception("Internal error");
		}
	}

	/**
	 * @param int $id
	 * @throws \Exception
	 * @return UserEntity
	 */
	public function getItem($id)
	{
		$data = $this->sqlSelect('SELECT * FROM users WHERE id = ?', array($id));
		if (count($data) != 1) throw new \Exception("Not found");
		return UserEntity::fromDBArray($data[0]);
	}

	/**
	 * @param int $offset
	 * @param int $limit
	 * @return UserEntity[]
	 */
	public function getItems($offset, $limit)
	{
		$ret   = $this->sqlSelect('SELECT * FROM users ORDER BY username LIMIT ?, ?', array($offset, $limit));
		$parts = array();
		foreach ($ret as $part) $parts[] = UserEntity::fromDBArray($part);
		return $parts;
	}

	/**
	 * @param string $username
	 * @param string $pwd
	 */
	private function savePassword($username, $pwd)
	{
		$file = file_get_contents($this->htpasswd_file);
		$enc_passwd = crypt($pwd, base64_encode($pwd));
		$lines = explode("\n", $file);
		$found = false;
		foreach ($lines as $line_nr => $line) {
			$x = explode(":", $line);
			if (count($x) == 2 && $x[0] == $username) {
				$found = true;
				$lines[$line_nr] = $x[0] . ":" . $enc_passwd;
			}
		}
		if (!$found) $lines[] = $username . ":" . $enc_passwd;
		file_put_contents($this->htpasswd_file, implode("\n", $lines));
	}

	/**
	 * @param UserEntity $item
	 * @return UserEntity
	 */
	public function updateItem($item)
	{
		if (strlen($item->password) == 40) {
			$stmt = $this->db->createStatement('UPDATE users SET animexx_id = ?, username = ? WHERE id = ?', new ParameterContainer(array(
				$item->animexx_id, $item->username, $item->id
			)));
			$stmt->execute();
		} else {
			$pwd_enc = sha1($item->password);
			$stmt    = $this->db->createStatement('UPDATE users SET animexx_id = ?, username = ?, password = ? WHERE id = ?', new ParameterContainer(array(
				$item->animexx_id, $item->username, $pwd_enc, $item->id
			)));
			$stmt->execute();
			$this->savePassword($item->username, $item->password);
		}
		return $this->getItem($item->id);
	}

	/**
	 * @param UserEntity $item
	 * @return UserEntity
	 */
	public function insertItem($item)
	{
		$pwd_enc = sha1($item->password);
		$stmt   = $this->db->createStatement('INSERT INTO users
			(animexx_id, username, password) VALUES (?, ?, ?)', new ParameterContainer(array(
			$item->animexx_id, $item->username, $pwd_enc
		)));
		$result = $stmt->execute();
		$this->savePassword($item->username, $item->password);

		$new_id = $result->getGeneratedValue();

		return $this->getItem($new_id);
	}

	/**
	 */
	public function getCount()
	{
		$ret = $this->sqlSelect('SELECT COUNT(*) num FROM users', array());
		return $ret[0]["num"];
	}


}
