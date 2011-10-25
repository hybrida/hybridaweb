<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class InnsidaIdentity extends CUserIdentity {

	protected $_id;
	protected $_userName;
	protected $_access;

	public function __construct($id) {
		parent::__construct($id, null);

		$this->_id = $id;
		$this->_access = array();
		$this->_userName = $id;
	}

	public function authenticate() {
		// kjører login-logikk

		$this->update();
		return true; // FIXME
	}

	public function update() {
		

		$user = User::model()->find("id = :id", array(":id" => $this->_id));
		$this->_userName = $user->username;


		$userInfo = $user->getAttributes();

		$this->setState("firstName", $userInfo['firstName']);
		$this->setState("middleName", $userInfo['middleName']);
		$this->setState("lastName", $userInfo['lastName']);
		$this->setState("member", $userInfo['member']);
		$this->setState("gender", $userInfo['gender']);
		$this->setState("imageId", $userInfo['imageId']);
		
		$this->setState("access", $user->access);
	}

	public function getName() {
		return $this->_userName;
	}

	public function getId() {
		return $this->_id;
	}

}