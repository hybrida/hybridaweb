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

	protected function makeAdminUser() {
		$this->markTestIncomplete();
	}

	public function testMakeNewNewsWithAdminPermissions() {
		$this->markTestIncomplete();
	}

}
?>

