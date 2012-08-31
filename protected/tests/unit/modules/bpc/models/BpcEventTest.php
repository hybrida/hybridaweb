<?php

Yii::import("bpc.models.*");
Yii::import("bpc.components.*");

class BpcEventTest extends CTestCase {
	/** @var BpcEvent */
	private $event;
	private $user;
	
	public function setUp() {
		$this->event = $this->getEvent();
		$this->user = Util::getNewUser();
		$this->user->graduationYear = YearConverter::classYearToGraduationYear(3);
		$this->user->save();
	}
	
	private function assertCanAttend($bool) {
		return $this->assertEquals($bool, $this->canAttend());
	}
	
	private function canAttend() {
		return $this->event->canAttend($this->user->id);
	}
	
	private function assertCanUnattend($bool) {
		return $this->assertEquals($bool, $this->canUnattend());
	}
	
	private function canUnattend() {
		return $this->event->canUnattend();
	}
	
	public function test_canAttend_userHasAccess_true() {
		$this->event->seats_available = 1;
		$this->event->seats = 2;
		$this->assertCanAttend(true);
	}
	
	public function test_canAttend_noSeatsAvailable_false() {
		$this->event->seats_available = 0;
		$this->event->seats = 1;
		$this->assertCanAttend(false);
	}
	
	public function test_canAttend_tooOld_false() {
		$this->user->graduationYear = YearConverter::classYearToGraduationYear(6);
		$this->user->save();
		$this->assertCanAttend(false);
	}
	
	public function test_canAttend_tooYoung_false() {
		$this->user->graduationYear = YearConverter::classYearToGraduationYear(2);
		$this->user->save();
		$this->assertCanAttend(false);
	}
	
	public function test_canAttend_deadlineHasPassed_false() {
		$this->event->deadline_passed = 1;
		$this->assertCanAttend(false);
	}
	
	public function test_canAttend_registrationHasntStarted_false() {
		$this->event->registration_started = 0;
		$this->assertCanAttend(false);
	}
	
	public function test_canUnattend_registrationHasntStarted_false() {
		$this->event->registration_started = 0;
		$this->assertCanUnattend(false);
	}
	
	public function test_canUnattend_deadlineHasPassed_false() {
		$this->event->deadline_passed = 1;
		$this->assertCanUnattend(false);
	}
	
	public function test_canUnattend_registrationIsOpen_true() {
		$this->assertCanUnattend(true);
	}
	
	public function getEvent() {
		$event = new BpcEventMock();
		$event->setAttributes(array(
			'id' => '381',
			'title' => 'Capgemini',
			'description' => 'Capgemini',
			'description_formatted' => '<p>Capgemini</p>',
			'time' => '2012-09-13 18:00:00',
			'place' => 'Unknown',
			'deadline' => '2012-09-12 11:00:00',
			'deadline_passed' => '0',
			'registration_start' => '2012-07-20 11:00:00',
			'registration_started' => '1',
			'seats' => '1',
			'seats_available' => 0,
			'this_attending' => '1',
			'open_for' => '1',
			'min_year' => '3',
			'max_year' => '5',
			'count_waiting' => '0',
			'waitlist_enabled' => '0',
			'web_page' => 'http://www.no.capgemini.com/',
			'is_advertised' => '1',
			'logo' => 'http://bpc.timini.no/image/200/22.jpg',
				), false);
		return $event;
	}

}

class BpcEventMock extends BpcEvent {
	public function __construct() {
		
	}
}