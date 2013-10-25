<?php

Yii::import("timetracker.models.*");


class TrackerLogTest extends CTestCase {


	public function test_construct_date_is_set () {
		$log = new TrackerLog();
		$this->assertNotNull($log->date);
	}

	public function test_find_date_is_set() {
		$log = Util::getNewTrackerLog();

		$date = "2012-01-01";
		$log->date = $date;
		$log->save();

		$log = TrackerLog::model()->findByPk($log->id);
		$this->assertEquals($date, $log->date);
	}
}
