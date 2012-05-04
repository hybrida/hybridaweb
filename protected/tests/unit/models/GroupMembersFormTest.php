<?php

class GroupMembersFormTest extends CTestCase {

	protected function setUp() {
		
	}

	protected function tearDown() {
		
	}

	private function getUser() {
		return Util::getUser();
	}

	private function getForm($group) {
		return new GroupMembersForm($group);
	}

	public function test_delete_all() {
		$u1 = $this->getUser();
		$u2 = $this->getUser();
		$group = Util::getGroup();
		$group->addMember($u1->id);
		$group->addMember($u2->id);
		$this->assertEquals(2, count($group->getMembers()));

		$input = array(
			'delete' => array(
				$u1->id => 1, $u2->id => 1,
			),
		);

		$form = $this->getForm($group);
		$form->setAttributes($input);
		$form->save();
		$members = $group->getMembers();
		$this->assertEmpty($members);
	}

	public function test_delete_some() {
		$u1 = $this->getUser();
		$u2 = $this->getUser();
		$group = Util::getGroup();
		$group->addMember($u1->id);
		$group->addMember($u2->id);
		$this->assertEquals(2, count($group->getMembers()));

		$input = array(
			'delete' => array(
				$u1->id => 1, $u2->id => 0,
			),
		);

		$form = $this->getForm($group);
		$form->setAttributes($input);
		$form->save();
		$members = $group->getMembers();
		$this->assertEquals(1, count($members));
		$this->assertContains($u2->id, $members);
	}
	
	public function test_add_one() {
		$u1 = $this->getUser();
		$group = Util::getGroup();

		$input = array(
			'add' => $u1->username,
		);

		$form = $this->getForm($group);
		$form->setAttributes($input);
		$form->save();
		$members = $group->getMembers();
		$this->assertEquals(1, count($members));
		$this->assertContains($u1->id, $members);
	}
	
		
	public function test_add_two() {
		$u1 = $this->getUser();
		$u2 = $this->getUser();
		$group = Util::getGroup();
		$input = array(
			'add' => "{$u1->username}\n{$u2->username}",
		);

		$form = $this->getForm($group);
		$form->setAttributes($input);
		$form->save();
		$members = $group->getMembers();
		$this->assertEquals(2, count($members));
		$this->assertContains($u1->id, $members);
		$this->assertContains($u2->id, $members);
	}

	public function test_insert() {
		$list = array(1, 2);
		$input = array(
			'add' => $list,
		);

		$group = Util::getGroup();
		$form = $this->getForm($group);
		$form->setAttributes($input);
		$this->assertEquals($list, $form->add);
	}

}
