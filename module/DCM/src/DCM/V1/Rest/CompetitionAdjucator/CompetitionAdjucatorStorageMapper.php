<?php
namespace DCM\V1\Rest\CompetitionAdjucator;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class CompetitionAdjucatorStorageMapper
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
	 * @param int $adjucator_id
	 * @throws \Exception
	 * @return CompetitionAdjucatorEntity
	 */
	public function getItem($competition_id, $adjucator_id)
	{
		$ret     = $this->sqlSelect('SELECT a.competition_id, a.user_id adjucator_id, b.username FROM ' .
			'competition_adjucators a JOIN users b ON a.user_id = b.id WHERE competition_id = ? AND adjucator_id = ?',
			array($competition_id, $adjucator_id)
		);
		return CompetitionAdjucatorEntity::fromDBArray($ret);
	}

	/**
	 * @param int $competition_id
	 * @param int $offset
	 * @param int $limit
	 * @return CompetitionAdjucatorEntity[]
	 */
	public function getItems($competition_id, $offset, $limit)
	{
		$ret     = $this->sqlSelect('SELECT a.competition_id, a.user_id adjucator_id, b.username FROM ' .
			'competition_adjucators a JOIN users b ON a.user_id = b.id WHERE competition_id = ? ORDER BY b.username LIMIT ?, ?',
			array($competition_id, $offset, $limit)
		);
		$parts = array();
		foreach ($ret as $r) $parts[] = CompetitionAdjucatorEntity::fromDBArray($r);
		return $parts;
	}

	/**
	 * @param int $competition_id
	 */
	public function getCount($competition_id)
	{
		$ret     = $this->sqlSelect('SELECT COUNT(*) num FROM competition_adjucators a JOIN users b ON a.user_id = b.id WHERE competition_id = ?',
			array($competition_id)
		);
		return $ret[0]["num"];
	}

}