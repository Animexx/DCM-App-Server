<?php
namespace DCM\V1\Rest\CompetitionGroup;

class CompetitionGroupEntity
{
	/** @var int $id */
	public $id;
	/** @var string $name */
	public $name;


	/**
	 * @param array $data
	 * @return CompetitionGroupEntity
	 */
	public static function fromArray($data) {
		$item = new CompetitionGroupEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	/**
	 * @param array $data
	 * @return CompetitionGroupEntity
	 */
	public static function fromDBArray($data) {
		$item = new CompetitionGroupEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}
}
