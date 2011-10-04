<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class InnsidaIdentity extends CUserIdentity {

	protected $_id;
	protected $_access;

	public function __construct($id) {
		$this->_id = $id;

		parent::__construct($id, null);
	}

	public function authenticate() {
		// kjører login-logikk
		
		$this->update();
		return true; // FIXME
	}

	public function update() {
		$user = User::model()->find("id = :id", array(":id" => $_id));
		$access = MembershipAccess::model()->findAll("userId = :id",array(":id" => $_id));
		print_r($access);
		
		
		
	}

}