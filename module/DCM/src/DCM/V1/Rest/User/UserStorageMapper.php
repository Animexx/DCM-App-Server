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

	/**
	 * @param Adapter $db
	 */
	public function __construct($db)
	{
		$this->db = $db;
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
	public function getItems($offset, $limit) {
		$ret = $this->sqlSelect('SELECT * FROM users ORDER BY `order` LIMIT ?, ?', array($offset, $limit) );
		$parts = array();
		foreach ($ret as $part) $parts[] = UserEntity::fromDBArray($part);
		return $parts;
	}

	/**
	 * @param UserEntity $item
	 * @return UserEntity
	 */
	public function updateItem($item)
	{
		$stmt = $this->db->createStatement('UPDATE users SET animexx_id = ?, username = ? WHERE id = ?', new ParameterContainer(array(
			$item->animexx_id, $item->username, $item->id
		)));
		$stmt->execute();
		return $this->getItem($item->id);
	}

	/**
	 * @param UserEntity $item
	 * @return UserEntity
	 */
	public function insertItem($item)
	{
		$stmt   = $this->db->createStatement('INSERT INTO users
			(id, animexx_id, username, password) VALUES (?, ?, ?, ?)', new ParameterContainer(array(
			$item->id, $item->animexx_id, $item->username, $item->password
		)));
		$result = $stmt->execute();

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
