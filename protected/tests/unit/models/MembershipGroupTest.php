<?php

class GroupMembershipTest extends CTestCase {

	private function getUser() {
		return Util::getUser();
	}

	private function getGroup() {
		return Util::getGroup();
	}

	public function test_create_validates() {
		$user = $this->getUser();
		$group = $this->getGroup();

		$ms = new GroupMembership;
		$ms->userId = $user->primaryKey;
		$ms->groupId = $group->primaryKey;
		$this->assertTrue($ms->save());
	}

	public function test_create() {
		$user = $this->getUser();
		$group = $this->getGroup();

		$ms = new GroupMembership;
		$ms->userId = $user->id;
		$ms->groupId = $group->id;
		$this->assertTrue($ms->save());

		$ms2 = GroupMembership::model()->find("userId = :uid AND groupId = :gid", array(
			':uid' => $user->id,
			':gid' => $group->id,
				));
		$this->assertNotNull($ms2);
	}

	public function test_addTwoUsersToGroup_count() {
		$user1 = $this->getUser();
		$user2 = $this->getUser();
		$group = $this->getGroup();

		$ms1 = new GroupMembership;
		$ms1->userId = $user1->id;
		$ms1->groupId = $group->id;
		$ms1->save();

		$ms2 = new GroupMembership;
		$ms2->userId = $user2->id;
		$ms2->groupId = $group->id;
		$ms2->save();

		$count = GroupMembership::model()->count("groupId = :groupId", array(
			':groupId' => $group->id,
				));

		$this->assertEquals(2, $count);
	}

}