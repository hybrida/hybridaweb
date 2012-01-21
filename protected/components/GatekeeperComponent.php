<?php

class GatekeeperComponent extends CApplicationComponent {
	
	private $gatekeeper;

	public function init() {
		$this->gatekeeper = new GateKeeper;
	}
	
	public function hasPostAccess($type, $id) {
		return $this->gatekeeper->hasAccess($type, $id);
	}

}