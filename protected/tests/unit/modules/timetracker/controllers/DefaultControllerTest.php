<?php

Yii::import("timetracker.controllers.*");


class DefaultControllerTest extends CTestCase {

	private $obj;

	public function setUp() {
		$this->obj = new DefaultController(NULL);
	}

	public function test_setUp () {
		$this->assertNotNull($this->obj);
	}

	public function test_userHasAccess_false_false () {
		$actual = $this->obj->userHasAccess(1231233);
		$this->assertFalse($actual);
	}

	public function test_userHasAccess_true_true() {
		$session = new Session;
		$trackerUser = Util::getTrackerUser();
		$session->login($trackerUser->user_id);
		$actual = $this->obj->userHasAccess($trackerUser->user_id);
		$this->assertTrue($actual);
	}

}