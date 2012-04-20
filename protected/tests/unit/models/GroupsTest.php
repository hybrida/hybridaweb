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
	}

}