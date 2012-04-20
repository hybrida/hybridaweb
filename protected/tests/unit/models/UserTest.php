<?php

class UserTest extends CTestCase {

	private function getNewUser() {
		return Util::getUser();
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
		$ms = new GroupMembership;
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
		$ms = new GroupMembership;
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
	
	public function test_save_cardNumber_is_Saved_to_CardHash_float() {
		$cardNumber = 12345678;
		$user = $this->getNewUser();
		$user->cardNumber = $cardNumber;
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals(sha1($cardNumber), $user2->cardHash);
	}
	
	public function test_save_cardNumber_is_Saved_to_CardHash_string() {
		$cardNumber = "12345678";
		$user = $this->getNewUser();
		$user->cardNumber = $cardNumber;
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals(sha1(12345678), $user2->cardHash);
	}	
	
	public function test_save_cardNumber_empty() {
		$user = $this->getNewUser();
		$user->cardNumber = "";
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals(null, $user2->cardHash);
	}
	
	public function test_save_cardNumber_correctLength() {
		$user = $this->getNewUser();
		$user->cardNumber = 123456789;
		$this->assertFalse($user->validate());
		$user->cardNumber = 1234;
		$this->assertFalse($user->validate());
		$user->cardNumber = 12345;
		$this->assertTrue($user->validate());
		$user->cardNumber = 12345678;
		$this->assertTrue($user->validate());
	}
	
}