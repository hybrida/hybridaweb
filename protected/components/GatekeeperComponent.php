<?php

class GatekeeperComponent extends CApplicationComponent {

	private $gatekeeper;

	public function init() {
		$this->gatekeeper = new GateKeeper;
	}

	public function hasPostAccess($type, $id) {
		return $this->gatekeeper->hasPostAccess($type, $id);
	}

	public function hasGroupAccess($groupId) {
		return $this->gatekeeper->hasAccessToGroup($groupId);
	}

	public function hasAccess($id) {
		return $this->gatekeeper->hasAccess($id);
	}

	public function hasBeenGroupMember($groupId) {
		$condition = "userID = :userID AND groupID = :groupID";
		$params = array(
			'userID' => user()->id,
			'groupID' => $groupId,
		);
		$numberOfMemberships = (int) GroupMembership::model()->count(
				$condition, $params);
		return $numberOfMemberships > 0;
	}

}