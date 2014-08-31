<?php
namespace DCM\V1\Rest\CompetitionRating;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class CompetitionRatingStorageMapper
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
	 * @param int $participant_id
	 * @param int $adjucator_id
	 * @throws \Exception
	 * @return CompetitionRatingEntity
	 */
	public function getItem($competition_id, $participant_id, $adjucator_id)
	{
		$ret     = $this->sqlSelect('SELECT * FROM competition_ratings WHERE competition_id = ? AND participant_id = ? AND adjucator_id = ?',
			array($competition_id, $participant_id, $adjucator_id)
		);
		$ratings = array();
		foreach ($ret as $r) $ratings[$r["criterion_id"]] = $r["rating"];
		return CompetitionRatingEntity::fromDBArray(array(
			"adjucator_id"   => $adjucator_id,
			"participant_id" => $participant_id,
			"competition_id" => $competition_id,
			"ratings"        => $ratings,
		));
	}

	/**
	 * @param int $competition_id
	 * @param int $participant_id
	 * @param int $offset
	 * @param int $limit
	 * @return CompetitionRatingEntity[]
	 */
	public function getItems($competition_id, $participant_id, $offset, $limit)
	{
		$ret     = $this->sqlSelect('SELECT * FROM competition_ratings WHERE competition_id = ? AND participant_id = ? ORDER BY adjucator_id LIMIT ?, ?',
			array($competition_id, $participant_id, $offset, $limit)
		);
		$ratings = $adjucators = array();
		foreach ($ret as $r) {
			if (!isset($ratings[$r["adjucator_id"]])) {
				$ratings[$r["adjucator_id"]] = array();
				$adjucators[]                = $r;
			}
			$ratings[$r["adjucator_id"]][$r["criterion_id"]] = $r["rating"];
		}
		$parts = array();
		foreach ($adjucators as $r) $parts[] = CompetitionRatingEntity::fromDBArray(array(
			"adjucator_id"   => $r["adjucator_id"],
			"participant_id" => $r["participant_id"],
			"competition_id" => $r["competition_id"],
			"ratings"        => $ratings[$r["adjucator_id"]],
		));
		return $parts;
	}

	/**
	 * @param int $competition_id
	 * @param int $participant_id
	 */
	public function getCount($competition_id, $participant_id)
	{
		$ret = $this->sqlSelect('SELECT COUNT(DISTINCT adjucator_id) num FROM competition_ratings WHERE
			competition_id = ? AND participant_id = ?', array($competition_id, $participant_id));
		return $ret[0]["num"];
	}

	/**
	 * @param CompetitionRatingEntity $item
	 * @return CompetitionRatingEntity
	 */
	public function updateItem($item)
	{
		$stmt = $this->db->createStatement('DELETE FROM competition_ratings WHERE adjucator_id = ? AND participant_id = ? ' .
			' AND competition_id = ?', new ParameterContainer(array(
				$item->adjucator_id, $item->participant_id, $item->competition_id
			)));
		$stmt->execute();

		foreach ($item->ratings as $criterion_id => $rating) {
			$stmt = $this->db->createStatement('INSERT INTO competition_ratings (adjucator_id, participant_id, competition_id, ' .
				'criterion_id, rating) VALUES (?, ?, ?, ?, ?)', new ParameterContainer(array(
					$item->adjucator_id, $item->participant_id, $item->competition_id, $criterion_id, $rating
				)));
			$stmt->execute();
		}

		return $this->getItem($item->competition_id, $item->participant_id, $item->adjucator_id);
	}

	/**
	 * @param CompetitionRatingEntity $item
	 * @return CompetitionRatingEntity
	 */
	public function insertItem($item)
	{
		$stmt = $this->db->createStatement('INSERT INTO competition_participants (competition_id, user_id, name, data) VALUES (?, ?, ?, ?)',
			new ParameterContainer(array($item->competition_id, $item->user_id, $item->name, $item->data
			)));
		$stmt->execute();

		return $this->getItem($item->competition_id, $item->user_id);
	}

}