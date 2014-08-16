<?php
namespace DCM\V1\Rest\CompetitionParticipant;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class CompetitionParticipantStorageMapper
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
	 * @param int $competition_id
	 * @param int $user_id
	 * @throws \Exception
	 * @return CompetitionParticipantEntity
	 */
	public function getItem($competition_id, $user_id)
	{
		$ret = $this->sqlSelect('SELECT * FROM competition_participants WHERE competition_id = ? AND user_id = ?',
			array($competition_id, $user_id)
		);
		if (count($ret) != 1) throw new \Exception("Not found");
		return CompetitionParticipantEntity::fromDBArray($ret[0]);
	}

	/**
	 * @param int $competition_id
	 * @param int $offset
	 * @param int $limit
	 * @return CompetitionParticipantEntity[]
	 */
	public function getItems($competition_id, $offset, $limit) {
		$ret = $this->sqlSelect('SELECT * FROM competition_participants WHERE competition_id = ? ORDER BY user_id LIMIT ?, ?',
			array($competition_id, $offset, $limit)
		);
		$parts = array();
		foreach ($ret as $part) $parts[] = CompetitionParticipantEntity::fromDBArray($part);
		return $parts;
	}

	/**
	 * @param int $competition_id
	 */
	public function getCount($competition_id)
	{
		$ret = $this->sqlSelect('SELECT COUNT(*) num FROM competition_participants WHERE competition_id = ?', array($competition_id));
		return $ret[0]["num"];
	}

	/**
	 * @param CompetitionParticipantEntity $item
	 * @return CompetitionParticipantEntity
	 */
	public function updateItem($item)
	{
		$stmt = $this->db->createStatement('UPDATE competition_participants SET name = ?, data = ? WHERE competition_id = ? AND user_id = ?',
			new ParameterContainer(array($item->name, $item->data, $item->competition_id, $item->user_id
		)));
		$stmt->execute();
		return $this->getItem($item->competition_id, $item->user_id);
	}

	/**
	 * @param CompetitionParticipantEntity $item
	 * @return CompetitionParticipantEntity
	 */
	public function insertItem($item)
	{
		$stmt   = $this->db->createStatement('INSERT INTO competition_participants (competition_id, user_id, name, data) VALUES (?, ?, ?, ?)',
			new ParameterContainer(array($item->competition_id, $item->user_id, $item->name, $item->data
		)));
		$stmt->execute();

		return $this->getItem($item->competition_id, $item->user_id);
	}

}