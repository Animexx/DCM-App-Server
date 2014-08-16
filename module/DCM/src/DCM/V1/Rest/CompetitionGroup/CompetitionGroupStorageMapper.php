<?php
namespace DCM\V1\Rest\CompetitionGroup;

use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception;

class CompetitionGroupStorageMapper implements AdapterInterface
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
	 * @return CompetitionGroupEntity
	 */
	public function getItem($id)
	{
		$data = $this->sqlSelect('SELECT * FROM competition_groups WHERE id = ?', array($id));
		if (count($data) != 1) throw new \Exception("Not found");
		return CompetitionGroupEntity::fromDBArray($data[0]);
	}

	/**
	 * @param int $offset
	 * @param int $limit
	 * @return CompetitionGroupEntity[]
	 */
	public function getItems($offset, $limit) {
		$ret = $this->sqlSelect('SELECT * FROM competition_groups ORDER BY name LIMIT ?, ?',
			array($offset, $limit)
		);
		$parts = array();
		foreach ($ret as $part) $parts[] = CompetitionGroupEntity::fromDBArray($part);
		return $parts;
	}

	/**
	 */
	public function count()
	{
		$ret = $this->sqlSelect('SELECT COUNT(*) num FROM competition_groups', array());
		return $ret[0]["num"];
	}


}