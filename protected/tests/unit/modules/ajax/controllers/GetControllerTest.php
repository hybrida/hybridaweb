<?php

Yii::import('ajax.controllers.GetController');
Yii::import('application.tests.testlib.Session');

class GetControllerTest extends CTestCase {

	private $clean;
	private $con;
	private $session;

	public function __construct() {
		$this->session = new Session();
	}

	public function setUp() {
		ob_start();
		$this->clean = true;
		$this->con = new GetController('');

	}

	public function tearDown() {
		if ($this->clean) {
			ob_clean();
		}
		user()->logout();
	}

	public function getOutput() {
		return ob_get_contents();
	}

	private function assertNonEmptyJSON() {
		$expectedFirstTwoChars = "[{";
		$this->assertEquals($expectedFirstTwoChars, substr($this->getOutput(),0,2), "JSON was not empty");
	}

	public function test_actionUserSearch_loggedOut_empty () {
		$this->session->logout();
		$this->con->actionUserSearch('sig');
		$this->assertEquals("[]", $this->getOutput());
	}

	public function test_actionNewsSearch_loggedIn_notEmpty() {
		$this->session->login(381);
		$this->con->actionNewsSearch('den');
		$this->assertNonEmptyJSON();
	}



}