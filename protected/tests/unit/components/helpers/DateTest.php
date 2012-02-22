<?php

class DateTest extends CTestCase {
	
	public function setUp() {
		DateMock::$isAutumn = false;
		DateMock::$year = 2012;
	}
	
	public function test_notAutumn() {
		DateMock::$isAutumn = false;
		DateMock::$year = 2012;
		$this->assertEquals(2, DateMock::convertGraduationYearToClassYear(2015));
		$this->assertEquals(2015, DateMock::convertClassYearToGraduationYear(2));
	}
	
	public function test_isAutumn() {
		DateMock::$isAutumn = false;
		DateMock::$year = 2015;
		$this->assertEquals(3, DateMock::convertGraduationYearToClassYear(2015));
		$this->assertEquals(2015, DateMock::convertClassYearToGraduationYear(3));
	}
	
}

class DateMock extends Date {
	public static $year;
	public static $isAutumn;
	
	public static function isAutumn() {
		return self::$isAutumn;
	}
	
	public static function getCurrentYear() {
		return self::$year;
	}
}