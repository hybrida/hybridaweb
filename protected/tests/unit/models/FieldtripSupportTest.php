<?php

Yii::import('bpc.models.*');
Yii::import('application.tests.mocks.BpcEventMock');

class FieldtripSupportMockTest extends CTestCase {

	private $user;
	private $event;

	public function setUp() {
		$this->user = Util::getUser();
		$this->event = BpcEventMock::mock();
	}

	public function test_setup() {
		$this->assertNotNull($this->user);
		$this->assertNotNull($this->event);
	}

	private function getSupport($fieldtrip) {
		return FieldtripSupportMock::model()->findByPk($fieldtrip->primaryKey);
	}

	private function support() {
		return FieldtripSupportMock::support($this->event, $this->user);
	}

	private function removeSupport() {
		return FieldtripSupportMock::removeSupport($this->event, $this->user);
	}

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
		$beforeCount = $this->modelCount();
		$this->support();
		$afterCount = $this->modelCount();
		$this->assertEquals($afterCount, $beforeCount + 1);
	}

	public function test_support_timestampIsDelete_set () {
		$fieldtrip = $this->support();
		$fieldtrip = $this->getSupport($fieldtrip);
		$this->assertNotNull($fieldtrip->timestamp);
		$this->assertEquals(0, $fieldtrip->isDeleted);
	}

	public function test_deleteSupport_isDeleteIs0() {
		$fieldtrip = $this->support();
		$this->removeSupport();
		$fieldtrip = $this->getSupport($fieldtrip);
		$this->assertEquals(1, $fieldtrip->isDeleted);
	}

	public function test_deleteSupport_isNoFieldtrip_nothingHappens() {
		$this->removeSupport();
	}

	public function test_support_supportAndUnsupportStressTest () {
		// Support
		$ft = $this->support();
		$ft = $this->getSupport($ft);
		$this->assertEquals(0, $ft->isDeleted);

		// Unsupport
		$this->removeSupport();
		$ft = $this->getSupport($ft);
		$this->assertEquals(1, $ft->isDeleted);

		// Support
		$this->support();
		$ft = $this->getSupport($ft);
		$this->assertEquals(0, $ft->isDeleted);

		// Unsupport
		$this->removeSupport();
		$ft = $this->getSupport($ft);
		$this->assertEquals(1, $ft->isDeleted);
	}
}

class FieldtripSupportMock extends FieldtripSupport {

	// Denne må overkjøres siden den i implementasjonen avhenger av ytre
	// tilstand som dato og om det er fildtrip dette året. Metoden kjører bare
	// canSupportDecoupled som testes nøye i denne testcasen. Derfor er dette
	// greit.
	public static function canSupport($user) {
		return true;
	}

}
