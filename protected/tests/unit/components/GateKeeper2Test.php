<?php

Yii::import('application.tests.mocks.GateKeeperMock');

class GateKeeper2Test extends CTestCase {

	private $session;
	private $gatekeeper;

	public function __construct() {
		$this->session = new Session();
	}

	public function setUp() {
		$this->gatekeeper = new GateKeeperMock;
	}

	private function getNewNews() {
		$news = new News;
		$news->title = "Test";
		$news->content = "Content";
		$this->assertTrue($news->save(), "News should have been saved");
		return $news;
	}

	private function getNewUser() {
		$user = new User;
		$user->firstName = 'Test';
		$user->lastName = 'Test';
		$user->username = 't' . User::model()->count();
		$user->member = "false";
		$this->assertTrue($user->save(), "User should have been saved");
		return $user;
	}

	private function assertHasAccess($expected, $userAccess, $postAccess) {
		$news = $this->getNewNews();
		$news->access = $postAccess;
		$news->save();
		$this->gatekeeper->setAccess($userAccess);

		$actual = $this->gatekeeper->hasAccess("news", $news->id);
		$this->assertEquals($expected, $actual);
	}

	private function assertHasAccessLoggedIn($expected, $user, $postAccess) {
		$this->assertHasAccess($expected, $user->access, $postAccess);
	}

	public function test_hasAccess_oneGroup_true() {
		$user = $this->getNewUser();
		$user->gender = "male";

		$array = array(Access::MALE);
		$this->assertHasAccessLoggedIn(true, $user, $array);
	}

	public function test_hasAccess_oneGroup_false() {
		$user = $this->getNewUser();
		$user->gender = "male";

		$postAccess = array(Access::FEMALE);
		$this->assertHasAccessLoggedIn(false, $user, $postAccess);
	}

	public function test_hasAccess_oneGroup_someIn_true() {
		$user = $this->getNewUser();
		$user->gender = "male";
		$user->specialization = 3;

		$array = array(Access::MALE);
		$this->assertHasAccessLoggedIn(true, $user, $array);
	}
	
	public function test_hasAccess_twoGroupInAndOneGroupOut() {
		$userAccess = array(2,3,2012,4002);
		$postAccess = array(2,3,2013,4002);
		$this->assertHasAccess(false, $userAccess, $postAccess);
	}
	

}



/*
 * Ting som må testes
 * ==================
 * 
 * 
 * 
 * Innad i en gruppe
 *  * Har tilgang
 *  * Ikke tilgang
 *  *
 * Med flere grupper og bare en i hver gruppe
 * Med flere grupper og flere i hver grupper
 * 
 * Det samme med flere sub-grupper
 */

	// 0001 - 1000 : Generelt
	// 1001 - 2000 : Kjønn
	// 2001 - 3000 : Avgangsår
	// 3001 - 4000 : Spesialisering
	// 4001 - 5000 : Grupper