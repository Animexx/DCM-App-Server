<?php
namespace DCM\V1\Rest\CompetitionRating;


use Zend\Paginator\Adapter\AdapterInterface;

class CompetitionRatingPaginatorAdapter implements AdapterInterface{

	/** @var CompetitionRatingStorageMapper $storageMapper */
	protected $storageMapper;
	/** @var int */
	protected $competition_id;
	protected $participant_id;

	/**
	 * @param CompetitionRatingStorageMapper $storageMapper
	 * @param int $competition_id
	 * @param int $participant_id
	 */
	public function __construct($storageMapper, $competition_id, $participant_id)
	{
		$this->storageMapper = $storageMapper;
		$this->competition_id = $competition_id;
		$this->participant_id = $participant_id;
	}

	/**
	 * @param int $adjucator_id
	 * @return CompetitionRatingEntity
	 */
	public function getItem($adjucator_id) {
		return $this->storageMapper->getItem($this->competition_id, $this->participant_id, $adjucator_id);
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
		return $this->storageMapper->getItems($this->competition_id, $this->participant_id, $offset, $itemCountPerPage);
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
		return $this->storageMapper->getCount($this->competition_id, $this->participant_id);
	}
}