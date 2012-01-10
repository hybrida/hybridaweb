<?php

class MembershipGroupTest extends CTestCase {
	
	private function getNewUser() {
		$user = new User();
		$user->username = "t".User::model()->count();
		$user->firstName = "Test";
		$user->lastName = "Test";
		$user->member = "true";
		$user->save();
		return $user;
	}
	
	private function getNewGroup() {
		$group = new Groups;
		$group->title = "g".Groups::model()->count();
		$group->menu = 123;
		$group->save();
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
		
		$ms2 = MembershipGroup::model()->find("userId = :uid AND groupId = :gid",array(
			':uid' => $user->id,
			':gid' => $group->id,
		));
		$this->assertNotNull($ms2);
	}

}