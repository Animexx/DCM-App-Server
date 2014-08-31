<?php
namespace DCM\V1\Rest\CompetitionAdjucator;

class CompetitionAdjucatorEntity
{
	/** @var int */
	var $competition_id;
	var $adjucator_id;

	/** @var string */
	var $username;

	/**
	 * @param array $data
	 * @return CompetitionAdjucatorEntity
	 */
	public static function fromArray($data) {
		$item = new CompetitionAdjucatorEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	public static function fromDBArray($data) {
		$item = new CompetitionAdjucatorEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}
}
