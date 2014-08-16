<?php
namespace DCM\V1\Rest\Competition;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class CompetitionStorageMapper
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
	 * @param int $competition_group_id
	 * @param int $id
	 * @throws \Exception
	 * @return CompetitionEntity
	 */
	public function getItem($competition_group_id, $id)
	{
		$data = $this->sqlSelect('SELECT * FROM competitions WHERE id = ? AND group_id = ?', array($id, $competition_group_id));
		if (count($data) != 1) throw new \Exception("Not found");
		return CompetitionEntity::fromDBArray($data[0]);
	}

	/**
	 * @param int $competition_group_id
	 * @param int $offset
	 * @param int $limit
	 * @return CompetitionEntity[]
	 */
	public function getItems($competition_group_id, $offset, $limit) {
		$ret = $this->sqlSelect('SELECT * FROM competitions WHERE group_id = ? ORDER BY date LIMIT ?, ?',
			array($competition_group_id, $offset, $limit)
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
			date = ?, max_participants = ? WHERE id = ? AND group_id = ?', new ParameterContainer(array(
			$item->preliminary_of, $item->animexx_event_id, $item->name, $item->date, $item->max_participants, $item->id, $item->group_id
		)));
		$stmt->execute();
		return $this->getItem($item->group_id, $item->id);
	}

	/**
	 * @param CompetitionEntity $item
	 * @return CompetitionEntity
	 */
	public function insertItem($item)
	{
		$stmt   = $this->db->createStatement('INSERT INTO competitions (group_id, preliminary_of, animexx_event_id, name, date,
			max_participants) VALUES (?, ?, ?, ?, ?, ?)', new ParameterContainer(array(
			$item->group_id, $item->preliminary_of, $item->animexx_event_id, $item->name, $item->date, $item->max_participants
		)));
		$result = $stmt->execute();

		$new_id = $result->getGeneratedValue();

		return $this->getItem($item->group_id, $new_id);
	}

	/**
	 * @param int $competition_group_id
	 * @return int
	 */
	public function getCount($competition_group_id)
	{
		$ret = $this->sqlSelect('SELECT COUNT(*) num FROM competitions WHERE group_id = ?', array($competition_group_id));
		return $ret[0]["num"];
	}


}