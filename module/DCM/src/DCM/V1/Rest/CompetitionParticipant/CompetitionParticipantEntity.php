<?php
namespace DCM\V1\Rest\CompetitionParticipant;

class CompetitionParticipantEntity
{
	/** @var int */
	var $competition_id;
	/** @var int */
	var $user_id;
	/** @var string */
	var $name;
	/** @var array */
	var $data;

	/**
	 * @param array $data
	 * @return CompetitionParticipantEntity
	 */
	public static function fromArray($data) {
		$item = new CompetitionParticipantEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	public static function fromDBArray($data) {
		$item = new CompetitionParticipantEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}
}
