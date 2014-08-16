<?php
namespace DCM\V1\Rest\Competition;

class CompetitionEntity
{
	/** @var int */
	public $id;
	/** @var int */
	public $preliminary_of;
	/** @var int */
	public $animexx_event_id;
	/** @var string */
	public $name;
	/** @var string */
	public $date;
	/** @var int */
	public $max_participants;
	/** @var int */
	public $group_id;

	/**
	 * @param array $data
	 * @return CompetitionEntity
	 */
	public static function fromArray($data) {
		$item = new CompetitionEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	/**
	 * @param array $data
	 * @return CompetitionEntity
	 */
	public static function fromDBArray($data) {
		$item = new CompetitionEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}
}
