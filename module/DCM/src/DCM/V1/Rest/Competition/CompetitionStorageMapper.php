<?php
namespace DCM\V1\Rest\Competition;

use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class CompetitionStorageMapper implements AdapterInterface
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
	 * @return CompetitionEntity
	 */
	public function getItem($id)
	{
		$data = $this->sqlSelect('SELECT * FROM competitions WHERE id = ?', array($id));
		if (count($data) != 1) throw new \Exception("Not found");
		return CompetitionEntity::fromDBArray($data[0]);
	}

	/**
	 * @param int $offset
	 * @param int $limit
	 * @return CompetitionEntity[]
	 */
	public function getItems($offset, $limit) {
		$ret = $this->sqlSelect('SELECT * FROM competitions ORDER BY date LIMIT ?, ?',
			array($offset, $limit)
		);
		$parts = array();
		foreach ($ret as $part) $parts[] = CompetitionEntity::fromDBArray($part);
		return $parts;
	}

	/**
	 * @param CompetitionEntity $item
	 * @return CompetitionEntity
	 */
	public function updateItem($item)
	{
		$stmt = $this->db->createStatement('UPDATE competitions SET preliminary_of = ?, animexx_event_id = ?, name = ?,
			date = ?, max_participants = ? WHERE id = ?', new ParameterContainer(array($item->preliminary_of, $item->animexx_event_id,
			$item->name, $item->date, $item->max_participants, $item->id
		)));
		$stmt->execute();
		return $this->getItem($item->id);
	}

	/**
	 * @param CompetitionEntity $item
	 * @return CompetitionEntity
	 */
	public function insertItem($item)
	{
		$stmt   = $this->db->createStatement('INSERT INTO competitions (preliminary_of, animexx_event_id, name, date,
			max_participants) VALUES (?, ?, ?, ?, ?)', new ParameterContainer(array($item->preliminary_of, $item->animexx_event_id,
			$item->name, $item->date, $item->max_participants
		)));
		$result = $stmt->execute();

		$new_id = $result->getGeneratedValue();

		return $this->getItem($new_id);
	}

	/**
	 */
	public function count()
	{
		$ret = $this->sqlSelect('SELECT COUNT(*) num FROM competitions', array());
		return $ret[0]["num"];
	}


}