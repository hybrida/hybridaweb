<?php

class YearConverter {

	protected static $year = null;
	protected static $isAutumn = null;

	public static function init() {
		if (!self::$year)
			self::$year = date('Y');
		if (!self::$isAutumn)
			self::$isAutumn = date('n') >= 7;
	}

	public static function graduationYearToClassYear($graduationYear) {
		if (self::$isAutumn) {
			return self::$year - $graduationYear + 6;
		} else {
			return self::$year - $graduationYear + 5;
		}
	}

	public static function classYearToGraduationYear($classYear) {
		if (self::$isAutumn) {
			return self::$year + 6 - $classYear;
		} else {
			return self::$year + 5 - $classYear;
		}
	}

	public static function getFreshmanGraduationYear() {
		if (self::$isAutumn) {
			return self::$year + 5;
		}
		return self::$year + 4;
	}

	public static function getCurrentGraduationYearsArray() {
		$years = array();
		foreach (self::getCurrentClassYears() as $i) {
			$years[] = self::classYearToGraduationYear($i);
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

YearConverter::init();