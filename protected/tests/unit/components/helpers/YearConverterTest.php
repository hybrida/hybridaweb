<?php

class YearConverterTest extends CTestCase {

	public function setUp() {
		DateMock::init();
		DateMock::$isAutumn = false;
		DateMock::$year = 2012;
	}

	public function test_notAutumn() {
		DateMock::$isAutumn = false;
		DateMock::$year = 2012;
		$this->assertEquals(2, DateMock::graduationYearToClassYear(2015));
		$this->assertEquals(2015, DateMock::classYearToGraduationYear(2));
	}

	public function test_year2000() {
		DateMock::$year = 2000;
		DateMock::$isAutumn = true;
		$this->assertEquals(3, DateMock::graduationYearToClassYear(2003));
		$this->assertEquals(2005, DateMock::classYearToGraduationYear(1));
		$this->assertEquals(2004, DateMock::classYearToGraduationYear(2));
		$this->assertEquals(2003, DateMock::classYearToGraduationYear(3));
		$this->assertEquals(2002, DateMock::classYearToGraduationYear(4));
		$this->assertEquals(2001, DateMock::classYearToGraduationYear(5));
	}

	public function test_isAutumn() {
		DateMock::$isAutumn = true;
		DateMock::$year = 2012;
		$this->assertEquals(3, DateMock::graduationYearToClassYear(2015));
		$this->assertEquals(2015, DateMock::classYearToGraduationYear(3));
	}

	public function test_getCurrentClassYears() {
		$years = array(1, 2, 3, 4, 5);
		$this->assertEquals($years, DateMock::getCurrentClassYears());
	}

	public function test_getCurrentGradYears() {
		$years = array(2016, 2015, 2014, 2013, 2012);
		$this->assertEquals($years, DateMock::getCurrentGraduationYearsArray());
	}

	public function test_getFreshmanGraduationYearIsAutumn() {
		DateMock::$year = 2000;
		DateMock::$isAutumn = true;
		$this->assertEquals(2005, DateMock::getFreshmanGraduationYear());
	}

	public function test_getFreshmanGraduationYearNotAutumn() {
		DateMock::$year = 2000;
		DateMock::$isAutumn = false;
		$this->assertEquals(2004, DateMock::getFreshmanGraduationYear());
	}
	
	public function test_() {
		DateMock::$year = 2012;
		DateMock::$isAutumn = false;
		$this->assertEquals(3, DateMock::graduationYearToClassYear(2014));
	}

}

class DateMock extends YearConverter_PHP_5_3 {

	public static $year;
	public static $isAutumn;

	public static function init() {
		
	}

}