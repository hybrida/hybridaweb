<?php

Yii::import('bpc.models.*');
Yii::import('application.tests.mocks.BpcEventMock');

class FieldtripSupportMockTest extends CTestCase {

	private function assertCanSupportDecoupled($expected, $user, $isSpring, $isFieldtripThisYear) {
		$actual = FieldtripSupportMock::canSupportDecoupled($user, $isSpring, $isFieldtripThisYear);
		$this->assertEquals($expected, $actual);
	}

	private function modelCount() {
		return FieldtripSupportMock::model()->count();
	}

	public function test_canSupport_firstYear() {
		$user = Util::getNewUser();
		$user->classYear = 1;
		$user->save();

		//$is->assertCanSupportDecoupled(false, $user, spring, thisyear);
		$this->assertCanSupportDecoupled(false, $user, false, true);
		$this->assertCanSupportDecoupled(false, $user, false, false);
		$this->assertCanSupportDecoupled(false, $user, true, true);
		$this->assertCanSupportDecoupled(false, $user, true, false);
	}

	public function test_canSupport_secondYear() {
		$user = Util::getNewUser();
		$user->classYear = 2;
		$user->save();

		//$is->assertCanSupportDecoupled(false, $user, spring, thisyear);
		$this->assertCanSupportDecoupled(false, $user, false, true);
		$this->assertCanSupportDecoupled(false, $user, false, false);
		$this->assertCanSupportDecoupled(false, $user, true, true);
		$this->assertCanSupportDecoupled(true, $user, true, false);
	}

	public function test_canSupport_thirdYear() {
		$user = Util::getNewUser();
		$user->classYear = 3;
		$user->save();

		//$assertCanSupportDecoupled($expected, $user, spring, thisyear);
		$this->assertCanSupportDecoupled(false, $user, false, true);
		$this->assertCanSupportDecoupled(true, $user, false, false);
		$this->assertCanSupportDecoupled(true, $user, true, true);
		$this->assertCanSupportDecoupled(true, $user, true, false);
	}

	public function test_canSupport_fourthYear() {
		$user = Util::getNewUser();
		$user->classYear = 4;
		$user->save();

		//$assertCanSupportDecoupled($expected, $user, spring, thisyear);
		$this->assertCanSupportDecoupled(false, $user, false, true);
		$this->assertCanSupportDecoupled(true, $user, false, false);
		$this->assertCanSupportDecoupled(true, $user, true, true);
		$this->assertCanSupportDecoupled(false, $user, true, false);
	}

	public function test_canSupport_fifthYear() {
		$user = Util::getNewUser();
		$user->classYear = 5;
		$user->save();

		//$assertCanSupportDecoupled($expected, $user, spring, thisyear);
		$this->assertCanSupportDecoupled(false, $user, false, true);
		$this->assertCanSupportDecoupled(false, $user, false, false);
		$this->assertCanSupportDecoupled(false, $user, true, true);
		$this->assertCanSupportDecoupled(false, $user, true, false);
	}


	public function test_isFieldtripOnYear_2012_true() {
		$this->assertTrue(FieldtripSupportMock::isFieldtripOnYear(2012));
	}

	public function test_isFieldtripOnYear_2013_false() {
		$this->assertFalse(FieldtripSupportMock::isFieldtripOnYear(2013));
	}

	public function test_canSupport_nullInput_false() {
		$user = null;
		$canSupport = FieldtripSupport::canSupport($user);
		$this->assertFalse($canSupport);
	}

	public function test_canSupport_withMock_modelCountIncremented() {
		$user = Util::getNewUser();
		$randomClassYear = 100;
		$user->classYear = $randomClassYear;
		$user->save();
		$event = BpcEventMock::mock();
		$beforeCount = $this->modelCount();
		FieldtripSupportMock::support($event, $user);
		$afterCount = $this->modelCount();
		$this->assertEquals($afterCount, $beforeCount + 1);
	}

	public function test_support_timestampIsDelete_set () {
		$user = Util::getUser();
		$event = BpcEventMock::mock();
		$fieldtrip = FieldtripSupportMock::support($event, $user);
		$fieldtrip = FieldtripSupport::model()->findByPk($fieldtrip->id);
		$this->assertNotNull($fieldtrip->timestamp);
		$this->assertEquals(0, $fieldtrip->isDeleted);
	}

	public function test_deleteSupport_isDeleteIs0() {
		$user = Util::getUser();
		$event = BpcEventMock::mock();
		$fieldtrip = FieldtripSupportMock::support($event, $user);

		FieldtripSupport::removeSupport($event, $user);
		$fieldtrip = FieldtripSupport::model()->findByPk($fieldtrip->id);
		$this->assertEquals(1, $fieldtrip->isDeleted);
	}

	public function test_deleteSupprot_isNoFieldtrip_nothingHappens() {
		$user = Util::getUser();
		$event = BpcEventMock::mock();

		FieldtripSupport::removeSupport($event, $user);
	}

}

class FieldtripSupportMock extends FieldtripSupport {

	public static function canSupport($user) {
		return true;
	}

}
