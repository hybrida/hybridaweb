<?php

Yii::import('application.tests.mocks.GateKeeperMock');

class GateKeeperTest extends CTestCase {

	private $session;
	private $gatekeeper;
	public static $LOGGED_OUT = array();

	public function __construct() {
		$this->session = new Session();
	}

	public function setUp() {
		$this->gatekeeper = new GateKeeperMock;
	}

	private function getNews() {
		$news = new News;
		$news->title = "Test";
		$news->content = "Content";
		$this->assertTrue($news->save(), "News should have been saved");
		return $news;
	}

	private function getUser() {
		$user = new User;
		$user->firstName = 'Test';
		$user->lastName = 'Test';
		$user->username = 't' . User::model()->count();
		$user->member = "false";
		$this->assertTrue($user->save(), "User should have been saved");
		return $user;
	}

	private function assertHasAccess($expected, $userAccess, $accessID) {
		$this->gatekeeper->setAccess($userAccess);
		$actual = $this->gatekeeper->hasAccess($accessID);
		$this->assertEquals($expected, $actual);
	}

	private function assertHasPostAccess($expected, $userAccess, $postAccess) {
		$news = $this->getNews();
		$news->access = $postAccess;
		$news->save();
		$this->gatekeeper->setAccess($userAccess);

		$actual = $this->gatekeeper->hasPostAccess("news", $news->id);
		$this->assertEquals($expected, $actual);
	}

	private function assertHasPostAccessLoggedIn($expected, $user, $postAccess) {
		$this->assertHasPostAccess($expected, $user->access, $postAccess);
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

	public function test_hasPostAccess_LoggedIn_empty_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array();
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_LoggedIn_someInSomeOut_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array(1, 2, 3);
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_LoggedIn_someIn_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array(1, 52);
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_LoggedIn_allIn_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$this->assertHasPostAccess(true, $userAccess, $userAccess);
	}

	public function test_hasPostAccess_LoggedIn_someOut_false() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array(1000123, 123123);
		$this->assertHasPostAccess(false, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_LoggedIn_allInSomeOut_true() {
		$userAccess = array(1, 10, 52, 56, 199);
		$postAccess = array_merge($userAccess, array(1, 2, 3, 4, 5, 6, 7, 8));
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_LoggedOut_empty_true() {
		$userAccess = self::$LOGGED_OUT;
		$postAccess = array();
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_LoggedOut_someOut_false() {
		$userAccess = self::$LOGGED_OUT;
		$postAccess = array(1);
		$this->assertHasPostAccess(false, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_oneGroup_true() {
		$user = $this->getUser();
		$user->gender = "male";

		$array = array(Access::MALE);
		$this->assertHasPostAccessLoggedIn(true, $user, $array);
	}

	public function test_hasPostAccess_oneGroup_false() {
		$user = $this->getUser();
		$user->gender = "male";

		$postAccess = array(Access::FEMALE);
		$this->assertHasPostAccessLoggedIn(false, $user, $postAccess);
	}

	public function test_hasPostAccess_oneGroup_someIn_true() {
		$user = $this->getUser();
		$user->gender = "male";
		$user->specializationId = 3;

		$array = array(Access::MALE);
		$this->assertHasPostAccessLoggedIn(true, $user, $array);
	}

	public function test_hasPostAccess_twoGroupInAndOneGroupOut() {
		$userAccess = array(2, 3, 2012, 4002);
		$postAccess = array(2, 3, 2013, 4002);
		$this->assertHasPostAccess(false, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_twoSubGroups_true() {
		$userAccess = array(2, 3, 2012, 4004);
		$postAccess = array(
			array(1, 2, 3, 4),
			array(2, 4004),
		);
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_threeEmptySubGroups_true() {
		$userAccess = array(2, 3, 4, 2017);
		$postAccess = array(
			array(),
			array(),
			array(),
		);
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_someSubGroupsInSomeOut_true() {
		$userAccess = array(2, 1001, 3004);
		$postAccess = array(
			array(2, 1001),
			array(1, 3004),
			array(123123, 7405284),
		);
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_allSubGroupsOut_false() {
		$userAccess = array(1, 1000, 1200);
		$postAccess = array(
			array(2),
			array(4, 1001),
			array(2013),
			array(1000, 1200, 1, 3000),
		);
		$this->assertHasPostAccess(false, $userAccess, $postAccess);
	}

	// Sjekker om 1000 og 1005 er i samme accessGruppe, slik de skal.
	public function test_hasPostAccess_accessIdsDivisibleBy1000_true() {
		$userAccess = array(1005);
		$postAccess = array(
			array(1005, 1000)
		);
		$this->assertHasPostAccess(true, $userAccess, $postAccess);
	}

	public function test_hasPostAccess_UserInput_true() {
		$user = $this->getUser();
		$user->gender = "male";
		$user->save();
		$postAccess = array(
			array(Access::MALE, Access::REGISTERED, Access::FEMALE),
		);
		$this->assertHasPostAccess(true, $user->access, $postAccess);
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
		$user = $this->getUser();
		$group = $this->getGroup();
		$group->addMember($user->id);
		$this->assertHasAccessToGroup($user, $group->id);
	}

	private function getGroup() {
		$group = new Groups;
		$group->url = $group->title = "s" . Groups::model()->count();

		$group->save();
		return $group;
	}

	public function test_hasAccessToGroup_oneGroup_false() {
		$group = $this->getGroup();
		$user = $this->getUser();
		$this->assertHasNotAccessToGroup($user, $group);
	}

	public function test_hasAccessID_registered_true() {
		$user = $this->getUser();
		$this->assertHasAccess(true, $user->access, Access::REGISTERED);
	}

	public function test_hasAccessID_gender_false() {
		$user = $this->getUser();
		$user->gender = "female";
		$user->save();
		$this->assertHasAccess(false, $user->access, Access::MALE);
	}

}