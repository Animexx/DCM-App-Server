<?php
namespace DCM\V1\Rest\CompetitionRatingCriterion;

class CompetitionRatingCriterionEntity
{

	/** @var int $id */
	public $id;
	/** @var int $competition_group_id */
	public $competition_group_id;
	/** @var string $name */
	public $name;
	/** @var int $order */
	public $order;
	/** @var int $max_rating */
	public $max_rating;
	/** @var int $weight */
	public $weight;

	/**
	 * @param array $data
	 * @return CompetitionRatingCriterionEntity
	 */
	public static function fromArray($data) {
		$item = new CompetitionRatingCriterionEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	/**
	 * @param array $data
	 * @return CompetitionRatingCriterionEntity
	 */
	public static function fromDBArray($data) {
		$item = new CompetitionRatingCriterionEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}
}
