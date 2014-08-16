<?php
namespace DCM\V1\Rest\Competition;


use Zend\Paginator\Adapter\AdapterInterface;

class CompetitionPaginatorAdapter implements AdapterInterface{

	/** @var CompetitionStorageMapper $storageMapper */
	protected $storageMapper;
	/** @var int $competition_group_id */
	protected $competition_group_id;

	/**
	 * @param CompetitionStorageMapper $storageMapper
	 * @param int $competition_group_id
	 */
	public function __construct($storageMapper, $competition_group_id)
	{
		$this->storageMapper = $storageMapper;
		$this->competition_group_id = $competition_group_id;
	}

	/**
	 * @param int $id
	 * @return CompetitionEntity
	 */
	public function getItem($id) {
		return $this->storageMapper->getItem($this->competition_group_id, $id);
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
		return $this->storageMapper->getItems($this->competition_group_id, $offset, $itemCountPerPage);
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
		return $this->storageMapper->getCount($this->competition_group_id);
	}
}