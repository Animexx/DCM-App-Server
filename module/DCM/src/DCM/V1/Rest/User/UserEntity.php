<?php
namespace DCM\V1\Rest\User;

class UserEntity
{
	/** @var int $id */
	public $id;
	/** @var int $animexx_id */
	public $animexx_id;
	/** @var string $username */
	public $username;
	/** @var string $password */
	public $password;
	/** @var int $sysadmin */
	public $sysadmin;
	/** @var int[] $adjucator_for */
	public $adjucator_for;

	/**
	 * @param array $data
	 * @return UserEntity
	 */
	public static function fromArray($data) {
		$item = new UserEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}

	/**
	 * @param array $data
	 * @return UserEntity
	 */
	public static function fromDBArray($data) {
		$item = new UserEntity();
		foreach ($data as $key => $val) if (property_exists($item, $key)) $item->$key = $val;
		return $item;
	}


}
