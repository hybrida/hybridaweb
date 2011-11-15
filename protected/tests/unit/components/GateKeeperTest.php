<?php

/**
 * Test class for GateKeeper.
 * Generated by PHPUnit on 2011-10-04 at 23:07:18.
 */

class GateKeeperTest extends PHPUnit_Framework_TestCase {

	private $userAccess = array(1, 10, 52, 56, 199);
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}

	private function assertHasAccessLoggedIn($expected, $array) {
		$this->session->loginNewUser($this->userAccess);
		$this->assertHasAccess($expected, $array);
	}

	private function assertHasAccessLoggedOut($expected, $array) {
		$this->session->logout();
		$this->assertHasAccess($expected, $array);
	}

	private function assertHasAccess($expected, $array) {
		$news = new News;
		$news->access = $array;
		$news->save();

		$actual = GateKeeper::hasAccess("news", $news->id);
		$this->assertEquals($expected, $actual);
	}

	public function test_hasAccess_LoggedIn_empty_true() {
		$this->assertHasAccessLoggedIn(true, array());
	}

	public function test_hasAccess_LoggedIn_someInSomeOut_false() {
		$this->assertHasAccessLoggedIn(false, array(1, 2, 3));
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

	public function test_hasAccess_LoggedIn_allInSomeOut_false() {
		$actual = array_merge($this->userAccess, array(1, 2, 3, 4, 5, 6, 7, 8));
		$this->assertHasAccessLoggedIn(false, $actual);
	}

	public function test_hasAccess_LoggedOut_empty_true() {
		$this->assertHasAccessLoggedOut(true, array());
	}

	public function test_hasAccess_LoggedOut_someOut_false() {
		$this->assertHasAccessLoggedOut(false, array(1));
	}


}