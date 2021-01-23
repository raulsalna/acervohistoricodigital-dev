<?php
namespace App\Http\Traits;

trait CustomModelLogic {
	/**
	 * @var bool
	 */
	public static $withoutAppends = false;

	/**
	 * Check if $withoutAppends is enabled.
	 *
	 * @return array
	 */
	protected function getArrayableAppends()
	{
		if(self::$withoutAppends){
			return [];
		}
		return parent::getArrayableAppends();
	}
}