<?php

class NewsEventFormTest extends PHPUnit_Framework_TestCase {

	protected $model;
	private $adminUser;
	private $groupLeader;
	private $groupMember;

	protected function setUp() {
		$this->setUpEvent();
	}

	private function setUpEvent() {
		$this->event = Event::model();
		$this->model = new NewsEventForm($this->event);
	}

	private function setUpNews() {
		$this->news = News::model();
		$this->model = new NewsEventForm($this->news);
	}

	public function testMakeAdminUser() {
		$this->adminUser = new User;
		$this->adminUser->firstName = rand(0,100000);
		$this->adminUser->lastName = rand(0,100000);
		$this->adminUser->username = rand(0,100000);
		$this->adminUser->member = true;
		
		$this->adminUser->save();
		
		$this->assertNotEquals(null,$this->adminUser->id);
	}

	public function testMakeNewNewsWithAdminPermissions() {
		$this->markTestIncomplete();
	}

}