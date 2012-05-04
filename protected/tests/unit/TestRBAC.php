<?php

Yii::import('application.tests.mocks.GateKeeperMock');

class TestRBAC extends CTestCase {

	private $styretGroupId = 56;

	private function getGatekeeper($user) {
		$gatekeeper = new GateKeeperMock;
		$gatekeeper->setAccess($user->access);
		return $gatekeeper;
	}

	public function test_memberOfStyret() {
		$user = Util::getUser();
		$group = Groups::model()->findByPk($this->styretGroupId);
		$group->addMember($user->id);
		$gatekeeper = $this->getGatekeeper($user);
		$hasAccessToGroup = $gatekeeper->hasAccessToGroup($group->id);
		$this->assertTrue($hasAccessToGroup);
	}

	public function test_memberOfGroup() {
		$user = Util::getUser();
		$group = Util::getGroup();
		$group->addMember($user->id);
		$gatekeeper = $this->getGatekeeper($user);

		$hasAccessToGroup = $gatekeeper->hasAccessToGroup($group->id);
		$this->assertTrue($hasAccessToGroup);
	}

}
