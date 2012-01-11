<?php

Yii::import('application.tests.mocks.GateKeeperMock');

class GateKeeperTest extends CTestCase {

	private $userAccess = array(1, 10, 52, 56, 199);
	private $session;
	private $gatekeeper;

	public function __construct() {
		$this->session = new Session();
	}
	
	public function setUp() {
		$this->gatekeeper = new GateKeeperMock;
	}

	private function assertHasAccessLoggedIn($expected, $array) {
		$this->gatekeeper->setAccess($this->userAccess);
		$this->assertHasAccess($expected, $array);
	}

	private function assertHasAccessLoggedOut($expected, $array) {
		$this->session->logout();
		$this->setUp();
		$this->assertHasAccess($expected, $array);
	}

	private function assertHasAccess($expected, $array) {
		$news = new News;
		$news->access = $array;
		$news->save();

		$actual = $this->gatekeeper->hasAccess("news", $news->id);
		$this->assertEquals($expected, $actual);
	}

	public function test_hasAccess_LoggedIn_empty_true() {
		$this->assertHasAccessLoggedIn(true, array());
	}

	public function test_hasAccess_LoggedIn_someInSomeOut_true() {
		$this->assertHasAccessLoggedIn(true, array(1, 2, 3));
	}

	public function test_hasAccess_LoggedIn_someIn_true() {
		$this->assertHasAccessLoggedIn(true, array(1, 52));
	}

	public function test_hasAccess_LoggedIn_allIn_true() {
		$this->assertHasAccessLoggedIn(true, $this->userAccess);
	}

	public function test_hasAccess_LoggedIn_someOut_false() {
		$this->assertHasAccessLoggedIn(false, array(1000123, 123123));
	}

	public function test_hasAccess_LoggedIn_allInSomeOut_true() {
		$actual = array_merge($this->userAccess, array(1, 2, 3, 4, 5, 6, 7, 8));
		$this->assertHasAccessLoggedIn(true, $actual);
	}

	public function test_hasAccess_LoggedOut_empty_true() {
		$this->assertHasAccessLoggedOut(true, array());
	}

	public function test_hasAccess_LoggedOut_someOut_false() {
		$this->assertHasAccessLoggedOut(false, array(1));
	}
	
	public function test_loggedIn_notGuest() {
		$this->session->loginNewUser();
		$gk = new GateKeeper;
		$this->assertFalse($gk->isGuest());
	}
	
	public function test_loggedOut_isGuest() {
		$this->session->logout();
		$gk = new GateKeeper;
		$this->assertTrue($gk->isGuest());
	}
	
	public function test_loggedOut_accessIsEmpty() {
		$this->session->logout();
		$gk = new GateKeeper;
		$this->assertEquals(array(),$gk->getUserAccess());
	}
	
	public function test_loggedOut_idIsNull() {
		$this->session->logout();
		$gk = new GateKeeper;
		$this->assertNull($gk->getUserId());
	}
	
}