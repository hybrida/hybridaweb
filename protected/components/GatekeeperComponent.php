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

}