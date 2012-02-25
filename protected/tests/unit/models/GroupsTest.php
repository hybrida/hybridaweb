<?php

class GroupsTest extends CTestCase {

	private function getNewUser() {
		$user = new User;
		$user->firstName = "Test";
		$user->lastName = "Test";
		$user->username = "t" . User::model()->count();
		$user->member = "false";
		$this->assertTrue($user->save());
		return $user;
	}

	private function getNewGroup() {
		$group = new Groups;
		$group->menu = 10;
		$group->url = $group->title = "Test".Groups::model()->count();
		$this->assertTrue($group->save());
		return $group;
	}

	public function test_create_validates() {
		$group = $this->getNewGroup();
		$this->assertTrue($group->save());
	}
	public function test_create() {
		$group = $this->getNewGroup();
		$this->assertTrue($group->save());
		$this->assertNotNull($group->id, "Id kan ikke være null.");
		
		$group2 = Groups::model()->findByPk($group->id);
		$this->assertNotNull($group2);
	}

	public function test_addMember() {
		$group = $this->getNewGroup();
		$user = $this->getNewUser();
		$this->assertTrue($group->addMember($user->id));

		$ms = GroupMembership::model()->find(
				"groupId = :groupId AND userId = :userId", array(
			':groupId' => $group->id,
			':userId' => $user->id,
				));

		$this->assertNotNull($ms);
	}

}