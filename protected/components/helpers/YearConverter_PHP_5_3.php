<?php

class YearConverter_PHP_5_3 {

	protected static $year = null;
	protected static $isAutumn = null;

	public static function init() {
		if (!static::$year)
			static::$year = date('Y');
		if (!static::$isAutumn)
			static::$isAutumn = date('n') >= 7;
	}

	public static function graduationYearToClassYear($graduationYear) {
		if (static::$isAutumn) {
			return static::$year - $graduationYear + 6;
		} else {
			return static::$year - $graduationYear + 5;
		}
	}

	public static function classYearToGraduationYear($classYear) {
		if (static::$isAutumn) {
			return static::$year + 6 - $classYear;
		} else {
			return static::$year + 5 - $classYear;
		}
	}

	public static function getFreshmanGraduationYear() {
		if (static::$isAutumn) {
			return static::$year + 5;
		}
		return static::$year + 4;
	}

	public static function getCurrentGraduationYearsArray() {
		$years = array();
		foreach (static::getCurrentClassYears() as $i) {
			$years[] = static::classYearToGraduationYear($i);
		}
		return $years;
	}

	public static function getCurrentClassYears() {
		$years = array();
		for ($i = 1; $i <= 5; $i++) {
			$years[] = $i;
		}
		return $years;
	}

}

YearConverter_PHP_5_3::init();