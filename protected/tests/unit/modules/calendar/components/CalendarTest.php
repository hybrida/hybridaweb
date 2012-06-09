<?php

Yii::import('calendar.components.*');

class CalendarTest extends CTestCase {

	public function testWeekNumberMonthStartsOnWeekday() {
		$calendar = new Calendar(06, 2012);
		$firstWeekNumber = $calendar->firstWeekNumber();
		$this->assertEquals(22, $firstWeekNumber);
	}
	
	public function testWeekNumberMonthStartsOnSunday() {
		$calendar = new Calendar(07, 2012);
		$firstWeekNumber = $calendar->firstWeekNumber();
		$this->assertEquals(26, $firstWeekNumber);
	}
	
	public function testWeekNumberMonthStartsOnMonday() {
		$calendar = new Calendar(10, 2012);
		$firstWeekNumber = $calendar->firstWeekNumber();
		$this->assertEquals(40, $firstWeekNumber);		
	}

}