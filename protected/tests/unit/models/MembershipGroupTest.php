<?php

class MembershipGroupTest extends CTestCase {

	private function getNewUser() {
		$user = new User();
		$user->username = "t" . User::model()->count();
		$user->firstName = "Test";
		$user->lastName = "Test";
		$user->member = "true";
		$user->save();
		return $user;
	}

	private function getNewGroup() {
		$group = new Groups;
		$group->url = $group->title = "g" . Groups::model()->count();
		$group->menu = 123;
		$group->save();
		$this->assertNotEquals(0, $group->id);
		return $group;
	}

	public function test_create_validates() {
		$user = $this->getNewUser();
		$group = $this->getNewGroup();

		$ms = new MembershipGroup;
		$ms->userId = $user->primaryKey;
		$ms->groupId = $group->primaryKey;
		$this->assertTrue($ms->save());
	}

	public function test_create() {
		$user = $this->getNewUser();
		$group = $this->getNewGroup();

		$ms = new MembershipGroup;
		$ms->userId = $user->id;
		$ms->groupId = $group->id;
		$this->assertTrue($ms->save());

		$ms2 = MembershipGroup::model()->find("userId = :uid AND groupId = :gid", array(
			':uid' => $user->id,
			':gid' => $group->id,
				));
		$this->assertNotNull($ms2);
	}

	public function test_addTwoUsersToGroup_count() {
		$user1 = $this->getNewUser();
		$user2 = $this->getNewUser();
		$group = $this->getNewGroup();

		$ms1 = new MembershipGroup;
		$ms1->userId = $user1->id;
		$ms1->groupId = $group->id;
		$ms1->save();

		$ms2 = new MembershipGroup;
		$ms2->userId = $user2->id;
		$ms2->groupId = $group->id;
		$ms2->save();

		$count = MembershipGroup::model()->count("groupId = :groupId", array(
			':groupId' => $group->id,
				));

		$this->assertEquals(2, $count);
	}

}