<?php
namespace DCM\V1\Rest\CompetitionRating;

class CompetitionRatingEntity
{
	/** @var int */
	var $competition_id;
	var $adjucator_id;
	var $participant_id;

	/** @var array $ratings */
	var $ratings;

	/**
	 * @param array $data
	 * @return CompetitionRatingEntity
	 */
	public static function fromArray($data) {
		$item = new CompetitionRatingEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	public static function fromDBArray($data) {
		$item = new CompetitionRatingEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}
}
