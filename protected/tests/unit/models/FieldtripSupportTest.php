<?php

Yii::import('bpc.models.*');
Yii::import('application.tests.mocks.BpcEventMock');

class FieldtripSupportTest extends CTestCase {

	private function assertCanSupport($expected, $user) {
		$this->assertEquals($expected, FieldtripSupport::canSupport($user));
	}

	private function modelCount() {
		return FieldtripSupport::model()->count();
	}

	public function test_canSupport_freshman_false() {
		$user = Util::getUser();
		$user->classYear = 1;
		$user->save();
		$this->assertCanSupport(false, $user);
	}

	public function test_canSupport_thirdYear_true() {
		$user = Util::getUser();
		$user->classYear = 3;
		$user->save();
		$this->assertCanSupport(true, $user);
	}

	public function test_isFieldtripOnYear_2012_true() {
		$this->assertTrue(FieldtripSupport::isFieldtripOnYear(2012));
	}

	public function test_isFieldtripOnYear_2013_false() {
		$this->assertFalse(FieldtripSupport::isFieldtripOnYear(2013));
	}

	public function test_canSupport_nullInput_false() {
		$this->assertCanSupport(false, null);
	}

	public function test_support_freshman_noNewRecord() {
		$modelCount = $this->modelCount();
		$user = Util::getUser();
		$user->classYear = 1;
		$user->save();
		$event = BpcEventMock::mock();
		FieldtripSupport::support($event, $user);
		$this->assertEquals($modelCount, $this->modelCount());
	}

	public function test_support_fifthYear_noNewRecord() {
		$modelCount = $this->modelCount();
		$user = Util::getUser();
		$user->classYear = 5;
		$user->save();
		$event = BpcEventMock::mock();
		FieldtripSupport::support($event, $user);
		$this->assertEquals($modelCount, $this->modelCount());
	}
	
}