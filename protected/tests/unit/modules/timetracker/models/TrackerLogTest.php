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

	public function test_save_twoOnTheSameDay_onlyOneInserted () {
		$date = "2012-01-02";
		$log = Util::getNewTrackerLog();
		$log->date = $date;
		$log->work_time = 10;
		$log->save();

		$log2 = Util::getNewTrackerLog();
		$log2->user_id = $log->user_id;
		$log2->date = $date;
		$log2->work_time = 12;
		$log2->save();

		$logs = TrackerLog::model()->findAll("user_id = ? and date = ?", array(
			$log->user_id,
			$date,
		));

		$this->assertEquals(1, count($logs));
		$this->assertEquals(12, $logs[0]->work_time);
	}

	public function test_find_workTimeWithDecimals () {
		$log = Util::getNewTrackerLog();
		$log->work_time = 15.87;

		$log->save();

		$actual = TrackerLog::model()->findByPK($log->id);
		$this->assertEquals(15.87, $actual->work_time);
	}
}
