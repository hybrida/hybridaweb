<?php

Yii::import('bpc.components.*');
Yii::import('bpc.models.*');

class BpcAttendingTest extends PHPUnit_Framework_TestCase {
	
	private function getUser() {
		return Util::getUser();
	}
	
	public function testGetActiveRecordsInYears() {
		$u1 = $this->getUser();
		$u1->setClassYear(1);
		$u2 = $this->getUser();
		$u2->setClassYear(1);
		$u3 = $this->getUser();
		$u3->setClassYear(2);
		
		$mock = new BpcAttendingMock();
		$mock->list = array($u1, $u2, $u3);
		$userInYearArray = $mock->getActiveRecordsInYearArray();
		$this->assertContains($u1, $userInYearArray[1]);
		$this->assertContains($u2, $userInYearArray[1]);
		$this->assertContains($u3, $userInYearArray[2]);
		$this->assertNotContains($u1, $userInYearArray[2]);
		$this->assertEmpty($userInYearArray[3]);
		$this->assertEmpty($userInYearArray[4]);
		$this->assertEmpty($userInYearArray[5]);
	}
	

}

class BpcAttendingMock extends BpcAttending {
	public $list;
	public function getActiveRecords() {
		return $this->list;
	}
	public function __construct() {
		
	}
}