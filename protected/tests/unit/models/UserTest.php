<?php

class UserTest extends CTestCase {

	private function getNewUser() {
		$user = new User;
		$user->username = "t" . User::model()->count();
		$user->firstName = "UserTest";
		$user->lastName = "getCleanUserObject";
		$user->member = "true";
		$user->save();
		return $user;
	}

	public function testUserIsCreatedWithInsert() {
		$user = $this->getNewUser();
		$user->save();

		$this->assertFalse($user->isNewRecord);
	}

	public function testUserIsCreatedWithSave() {
		$user = $this->getNewUser();
		$user->save();

		$this->assertNotEquals(null, $user->id);
	}

	public function testUserIsValidated() {
		$user = $this->getNewUser();
		$this->assertTrue($user->validate());
	}

	public function test_access_gender_male() {
		$user = $this->getNewUser();
		$user->gender = "male";
		$user->save();

		$user = User::model()->findByPk($user->id);

		$this->assertContains(Access::MALE, $user->access);
		$this->assertNotContains(Access::FEMALE, $user->access);
	}

	public function test_access_gender_female() {
		$user = $this->getNewUser();
		$user->gender = "female";
		$user->save();
		$user = User::model()->findByPk($user->id);

		$this->assertNotContains(Access::MALE, $user->access);
		$this->assertContains(Access::FEMALE, $user->access);
	}

	public function test_access_group_oneGroup() {
		$user = $this->getNewUser();
		$user->save();
		$groupId = 32;
		$groupAccessId = Access::GROUP_START + $groupId;
		$ms = new MembershipGroup;
		$ms->groupId = $groupId;
		$ms->userId = $user->id;
		$this->assertTrue($ms->save());

		$this->assertContains($groupAccessId, $user->access);
	}

	public function test_access_group_twoGroups() {
		$user = $this->getNewUser();
		$group1 = $this->getNewGroup();
		$group2 = $this->getNewGroup();
		$this->addGroupToUser($group1, $user);
		$this->addGroupToUser($group2, $user);
		
		$this->assertContains(Access::GROUP_START + $group1->id, $user->access);
		$this->assertContains(Access::GROUP_START + $group2->id, $user->access);
	}

	private function getNewGroup() {
		$group = new Groups;
		$group->url = $group->title = "g" . Groups::model()->count();
		$group->menu = 123;
		$group->save();
		return $group;
	}
	
	private function addGroupToUser($group, $user) {
		$ms = new MembershipGroup;
		$ms->groupId = $group->id;
		$ms->userId = $user->id;
		$this->assertTrue($ms->save(),"Membership burde vært lagret");
	}
	
	public function test_access_graduationYear() {
		$user = $this->getNewUser();
		$user->graduationYear = 2012;
		$user->save();
		
		$this->assertContains(2012, $user->access);
	}
	
	public function test_access_specialization() {
		$user = $this->getNewUser();
		$spec = 15;
		$user->specializationId = $spec;
		$user->save();
		
		$this->assertContains(Access::SPECIALIZATION_START + $spec, $user->access);
	}
	
	public function test_access_general_registered() {
		$user = $this->getNewUser();
		
		$this->assertContains(Access::REGISTERED, $user->access);
	}
	
	public function test_access_general_member_true() {
		$user = $this->getNewUser();
		$user->member = "true";
		$user->save();
		
		$this->assertContains(Access::MEMBER, $user->access);
	}
	
	public function test_access_general_member_false() {
		$user = $this->getNewUser();
		$user->member = "false";
		$user->save();
		
		$this->assertNotContains(Access::MEMBER, $user->access);
	}
	
	public function test_userHasSpecializationRelation() {
		$spec = new Specialization;
		$spec->name = "test";
		$spec->save();
		$user = $this->getNewUser();
		$user->specializationId = $spec->id;
		$user->save();
		$user2 = User::model()->findByPk($user->id);
		$this->assertNotNull($user2->specialization);
	}
	
}