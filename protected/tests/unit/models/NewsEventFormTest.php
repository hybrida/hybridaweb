<?php

class NewsEventFormTest extends PHPUnit_Framework_TestCase {

	protected $model;

	protected function setUp() {
		$this->setUpEvent();
	}

	protected function setUpEvent() {
		$this->event = Event::model();
		$this->model = new NewsEventForm($this->event);
	}

	protected function setUpNews() {
		$this->news = News::model();
		$this->model = new NewsEventForm($this->news);
	}

	public function testMakeAdminUser() {
		$adminUser = User::model();
		$adminUser->save();
		$this->assertNotEquals(null,$adminUser->id);
	}

	public function testMakeNewNewsWithAdminPermissions() {
		$this->markTestIncomplete();
	}

}
?>

