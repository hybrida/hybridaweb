<?php

Yii::import('application.tests.mocks.GateKeeperMock');

class GateKeeperTest extends CTestCase {

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
		$this->assertEquals(array(), $gk->getUserAccess());
	}

	public function test_loggedOut_idIsNull() {
		$this->session->logout();
		$gk = new GateKeeper;
		$this->assertNull($gk->getUserId());
	}

	public function test_hasAccess_LoggedIn_empty_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array();
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_LoggedIn_someInSomeOut_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array(1, 2, 3);
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_LoggedIn_someIn_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array(1, 52);
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_LoggedIn_allIn_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$this->assertHasAccess(true, $userAccess, $userAccess);
	}

	public function test_hasAccess_LoggedIn_someOut_false() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array(1000123, 123123);
		$this->assertHasAccess(false, $userAccess, $postAccess);
	}

	public function test_hasAccess_LoggedIn_allInSomeOut_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array_merge($userAccess, array(1, 2, 3, 4, 5, 6, 7, 8));
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_LoggedOut_empty_true() {
		$userAccess = array();
		$postAccess = array();
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_LoggedOut_someOut_false() {
		$userAccess = array();
		$postAccess = array(1);
		$this->assertHasAccess(false, $userAccess, $postAccess);
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
		$user->specializationId = 3;

		$array = array(Access::MALE);
		$this->assertHasAccessLoggedIn(true, $user, $array);
	}

	public function test_hasAccess_twoGroupInAndOneGroupOut() {
		$userAccess = array(2, 3, 2012, 4002);
		$postAccess = array(2, 3, 2013, 4002);
		$this->assertHasAccess(false, $userAccess, $postAccess);
	}

	public function test_hasAccess_twoSubGroups_true() {
		$userAccess = array(2, 3, 2012, 4004);
		$postAccess = array(
			array(1, 2, 3, 4),
			array(2, 4004),
		);
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_threeEmptySubGroups_true() {
		$userAccess = array(2, 3, 4, 2017);
		$postAccess = array(
			array(),
			array(),
			array(),
		);
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_someSubGroupsInSomeOut_true() {
		$userAccess = array(2, 1001, 3004);
		$postAccess = array(
			array(2, 1001),
			array(1, 3004),
			array(123123, 7405284),
		);
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_allSubGroupsOut_false() {
		$userAccess = array(1, 1000, 1200);
		$postAccess = array(
			array(2),
			array(4, 1001),
			array(2013),
			array(1000, 1200, 1, 3000),
		);
		$this->assertHasAccess(false, $userAccess, $postAccess);
	}

	// Sjekker om 1000 og 1005 er i samme accessGruppe, slik de skal.
	public function test_hasAccess_accessIdsDivisibleBy1000_true() {
		$userAccess = array(1005);
		$postAccess = array(
			array(1005, 1000)
		);
		$this->assertHasAccess(true, $userAccess, $postAccess);
	}

	public function test_hasAccess_UserInput_true() {
		$user = $this->getNewUser();
		$user->gender = "male";
		$user->save();
		$postAccess = array(
			array(Access::MALE, Access::REGISTERED, Access::FEMALE),
		);
		$this->assertHasAccess(true, $user->access, $postAccess);
	}

	private function assertHasAccessToGroup($user, $group) {
		$this->gatekeeper->setAccess($user->access);
		$this->assertTrue($this->gatekeeper->hasAccessToGroup($group));
	}

	private function assertHasNotAccessToGroup($user, $group) {
		$this->gatekeeper->setAccess($user->access);
		$this->assertFalse($this->gatekeeper->hasAccessToGroup($group->id));
	}

	public function test_hasAccessToGroup_oneGroup_true() {
		$user = $this->getNewUser();
		$group = $this->getNewGroup();
		$group->addMember($user->id);
		$this->assertHasAccessToGroup($user, $group->id);
	}

	private function getNewGroup() {
		$group = new Groups;
		$group->url = $group->title = "s" . Groups::model()->count();
		
		$group->save();
		return $group;
	}

	public function test_hasAccessToGroup_oneGroup_false() {
		$group = $this->getNewGroup();
		$user = $this->getNewUser();
		$this->assertHasNotAccessToGroup($user, $group);
	}

}