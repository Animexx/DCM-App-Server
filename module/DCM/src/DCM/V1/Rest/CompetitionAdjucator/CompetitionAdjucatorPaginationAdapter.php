<?php
namespace DCM\V1\Rest\CompetitionAdjucator;


use DCM\V1\Rest\CompetitionAdjucator\CompetitionAdjucatorStorageMapper;
use Zend\Paginator\Adapter\AdapterInterface;

class CompetitionAdjucatorPaginationAdapter implements AdapterInterface{

	/** @var CompetitionAdjucatorStorageMapper $storageMapper */
	protected $storageMapper;
	/** @var int */
	protected $competition_id;

	/**
	 * @param CompetitionAdjucatorStorageMapper $storageMapper
	 * @param int $competition_id
	 */
	public function __construct($storageMapper, $competition_id)
	{
		$this->storageMapper = $storageMapper;
		$this->competition_id = $competition_id;
	}

	/**
	 * @param int $adjucator_id
	 * @return CompetitionAdjucatorEntity
	 */
	public function getItem($adjucator_id) {
		return $this->storageMapper->getItem($this->competition_id, $adjucator_id);
	}

	/**
	 * Returns a collection of items for a page.
	 *
	 * @param  int $offset Page offset
	 * @param  int $itemCountPerPage Number of items per page
	 * @return array
	 */
	public function getItems($offset, $itemCountPerPage)
	{
		return $this->storageMapper->getItems($this->competition_id, $offset, $itemCountPerPage);
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Count elements of an object
	 * @link http://php.net/manual/en/countable.count.php
	 * @return int The custom count as an integer.
	 * </p>
	 * <p>
	 * The return value is cast to an integer.
	 */
	public function count()
	{
		return $this->storageMapper->getCount($this->competition_id);
	}
}