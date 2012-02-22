<?php

class Date {

	public static function convertGraduationYearToClassYear($graduationYear) {
		$year = self::getCurrentYear();
		if (self::isAutumn()) {
			return $graduationYear - $year;
		} else {
			return $graduationYear - $year - 1;
		}
	}

	public static function convertClassYearToGraduationYear($classYear) {
		$year = self::getCurrentYear();
		if (self::isAutumn()) {
			return $year + $classYear;
		} else {
			return $year + $classYear + 1;
		}
	}

	protected static function isAutumn() {
		return date('n') >= 7;
	}

	protected static function getCurrentYear() {
		return date('Y');
	}

}