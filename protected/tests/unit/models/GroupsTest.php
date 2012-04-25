<?php

class GroupsTest extends CTestCase {

	private function getUser() {
		return Util::getUser();
	}

	private function getGroup() {
		return Util::getGroup();
	}

	public function test_create_validates() {
		$group = $this->getGroup();
		$this->assertTrue($group->save());
	}
	public function test_create() {
		$group = $this->getGroup();
		$this->assertTrue($group->save());
		$this->assertNotNull($group->id, "Id kan ikke være null.");
		
		$group2 = Groups::model()->findByPk($group->id);
		$this->assertNotNull($group2);
	}

	public function test_addMember() {
		$group = $this->getGroup();
		$user = $this->getUser();
		$this->assertTrue($group->addMember($user->id));

		$ms = GroupMembership::model()->find(
				"groupId = :groupId AND userId = :userId", array(
			':groupId' => $group->id,
			':userId' => $user->id,
				));
		
		$this->assertNotNull($ms);
		$this->assertNotNull($ms->start);
		$this->assertNull($ms->end);
	}
	
	private function addMembership($groupId, $userId, $start, $end) {
		$ms = new GroupMembership();
		$ms->start = $start;
		$ms->end = $end;
		$ms->groupId = $groupId;
		$ms->userId = $userId;
		$ms->save();
	}
	
	private function getMemberships($groupId, $userId) {
		return GroupMembership::model()->findAll('groupId = ? AND userId = ?', array(
			$groupId, $userId,
		));
	}
	
	public function test_removeMember() {
		$group = $this->getGroup();
		$user = $this->getUser();
		$group->addMember($user->id);
		$group->removeMember($user->id);

		$ms = GroupMembership::model()->find(
				"groupId = :groupId AND userId = :userId", array(
			':groupId' => $group->id,
			':userId' => $user->id,
				));
		
		$this->assertNotNull($ms);
		$this->assertNotNull($ms->start);
		$this->assertNotNull($ms->end);
	}
	
	
	public function test_addMember_twoTimesInARow_twoMemberships() {
		$group = $this->getGroup();
		$user = $this->getUser();
		$this->addMembership($group->id, $user->id, "2010-11-12 12:12", null);
		$group->addMember($user->id);
		$memberships = $this->getMemberships($group->id, $user->id);
		$numberOfMemberships = count($memberships);

		$this->assertEquals(2, $numberOfMemberships);
	}
	
	public function test_addMember_twoTimesInARow_correctStartEndNullProperties() {
		$group = $this->getGroup();
		$user = $this->getUser();
		$earlyDummyStartDate = "2010-11-12";
		$this->addMembership($group->id, $user->id, $earlyDummyStartDate, null);
		$group->addMember($user->id);
		$memberships = $this->getMemberships($group->id, $user->id);
		$ms1 = $memberships[0];
		$ms2 = $memberships[1];
		
		$this->assertEquals($earlyDummyStartDate, $ms1->start);
		$this->assertNotNull($ms1->end);
		$this->assertNull($ms2->end);
		
	}

}