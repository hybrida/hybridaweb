<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class DefaultIdentity extends CUserIdentity {

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
		return $this->update(); //FIXME
	}

	public function update() {
		$user = User::model()->find("id = :id", array(":id" => $this->_id));
		if (!$user) {
			return false;
		}
		$this->_userName = $user->username;

		$info = $user->getAttributes();

        $this->setState("firstName", $info['firstName']);
        $this->setState("middleName", $info['middleName']);
        $this->setState("lastName", $info['lastName']);
		$this->setState("fullName", $user->fullName);
        $this->setState("member", $info['member']);
        $this->setState("gender", $info['gender']);
        $this->setState("imageId", $info['imageId']);
		$this->setState("cardinfo", $user->cardinfo ? $user->cardinfo : "");
		return true;
	}

	public function getName() {
		return $this->_userName;
	}

	public function getId() {
		return $this->_id;
	}

}