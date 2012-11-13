<?php

class UserTest extends CTestCase {

	private function getUser() {
		return Util::getUser();
	}

	
	private function getGroup() {
		return Util::getGroup();
	}

	public function testUserIsCreatedWithInsert() {
		$user = $this->getUser();
		$user->save();

		$this->assertFalse($user->isNewRecord);
	}

	public function testUserIsCreatedWithSave() {
		$user = $this->getUser();
		$user->save();

		$this->assertNotEquals(null, $user->id);
	}

	public function testUserIsValidated() {
		$user = $this->getUser();
		$this->assertTrue($user->validate());
	}

	public function test_access_gender_male() {
		$user = $this->getUser();
		$user->gender = "male";
		$user->save();

		$user = User::model()->findByPk($user->id);

		$this->assertContains(Access::MALE, $user->access);
		$this->assertNotContains(Access::FEMALE, $user->access);
	}

	public function test_access_gender_female() {
		$user = $this->getUser();
		$user->gender = "female";
		$user->save();
		$user = User::model()->findByPk($user->id);

		$this->assertNotContains(Access::MALE, $user->access);
		$this->assertContains(Access::FEMALE, $user->access);
	}

	public function test_access_group_oneGroup() {
		$user = $this->getUser();
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
		$user = $this->getUser();
		$group1 = $this->getGroup();
		$group2 = $this->getGroup();
		$this->addGroupToUser($group1, $user);
		$this->addGroupToUser($group2, $user);
		
		$this->assertContains(Access::GROUP_START + $group1->id, $user->access);
		$this->assertContains(Access::GROUP_START + $group2->id, $user->access);
	}
		
	public function test_access_MemberOfGroup() {
		$user = $this->getUser();
		$group = $this->getGroup();
		$group->addMember($user->id);
		$accessNumber = Access::GROUP_START + $group->id;
		$this->assertContains($accessNumber, $user->getAccess());
	}
	
	public function test_access_noLongerMemberOfGroup() {
		$user = $this->getUser();
		$group = $this->getGroup();
		$group->addMember($user->id);
		$group->removeMember($user->id);
		$accessNumber = Access::GROUP_START + $group->id;
		$this->assertNotContains($accessNumber, $user->getAccess());
	}

	private function addGroupToUser($group, $user) {
		$ms = new GroupMembership;
		$ms->groupId = $group->id;
		$ms->userId = $user->id;
		$this->assertTrue($ms->save(),"Membership burde vært lagret");
	}
	
	public function test_access_graduationYear() {
		$user = $this->getUser();
		$user->graduationYear = 2012;
		$user->save();
		
		$this->assertContains(2012, $user->access);
	}
	
	public function test_access_specialization() {
		$user = $this->getUser();
		$spec = 15;
		$user->specializationId = $spec;
		$user->save();
		
		$this->assertContains(Access::SPECIALIZATION_START + $spec, $user->access);
	}
	
	public function test_access_general_registered() {
		$user = $this->getUser();
		
		$this->assertContains(Access::REGISTERED, $user->access);
	}
	
	public function test_access_general_member_true() {
		$user = $this->getUser();
		$user->member = "true";
		$user->save();
		
		$this->assertContains(Access::MEMBER, $user->access);
	}
	
	public function test_access_general_member_false() {
		$user = $this->getUser();
		$user->member = "false";
		$user->save();
		
		$this->assertNotContains(Access::MEMBER, $user->access);
	}
	
	public function test_userHasSpecializationRelation() {
		$spec = new Specialization;
		$spec->name = "test";
		$spec->save();
		$user = $this->getUser();
		$user->specializationId = $spec->id;
		$user->save();
		$user2 = User::model()->findByPk($user->id);
		$this->assertNotNull($user2->specialization);
	}
	
	public function test_save_cardNumber_is_Saved_to_CardHash_float() {
		$cardNumber = 12345678;
		$user = $this->getUser();
		$user->cardNumber = $cardNumber;
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals(sha1($cardNumber), $user2->cardHash);
	}
	
	public function test_save_cardNumber_is_Saved_to_CardHash_string() {
		$cardNumber = "12345678";
		$user = $this->getUser();
		$user->cardNumber = $cardNumber;
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals(sha1(12345678), $user2->cardHash);
	}	
	
	public function test_save_cardNumber_empty() {
		$user = $this->getUser();
		$user->cardNumber = "";
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals(null, $user2->cardHash);
	}
	
	public function test_save_cardNumber_correctLength() {
		$user = $this->getUser();
		$user->cardNumber = 123456789;
		$this->assertFalse($user->validate());
		$user->cardNumber = 1234;
		$this->assertFalse($user->validate());
		$user->cardNumber = 12345;
		$this->assertTrue($user->validate());
		$user->cardNumber = 12345678;
		$this->assertTrue($user->validate());
	}
	
	public function test_get_studmail() {
		$user = $this->getUser();
		$studmail = $user->username . "@stud.ntnu.no";
		$this->assertEquals($studmail, $user->studmail);
	}
	
}
