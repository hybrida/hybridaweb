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
	protected $so;
	const DATA_DELIMITER = ",";

	public function __construct($data, $sign, $target) {
		parent::__construct(null, null);

		$this->so = new SSOclient($data, $sign, $REMOTE_ADDR, $target);

		$this->_id = -1;
		$this->_access = array();
		$this->_userName = $this->getUsernameFromData($data);
	}
	
	public static function getUsernameFromData($data) {
		$ar = explode(self::DATA_DELIMITER, $data);
		$index = array_search("username", $ar) + 1;
		return $ar[$index];
	}

	public function authenticate() {
		if ($this->so->oklogin()) {
			$this->update();
			return true;
		} else {
			return false;
		}
	}

	public function update() {
		$user = User::model()->find(
				"username = :username", 
				array(":username" => $this->_userName
				));
		$this->_id = $user->id;

		$userInfo = $user->getAttributes();

		$this->setState("firstName", $userInfo['firstName']);
		$this->setState("middleName", $userInfo['middleName']);
		$this->setState("lastName", $userInfo['lastName']);
		$this->setState("member", $userInfo['member']);
		$this->setState("gender", $userInfo['gender']);
		$this->setState("imageId", $userInfo['imageId']);

		$this->setState("access", $user->access);
	}

	public function getErrorMessage() {
		return $this->so->reason();
	}

	public function getName() {
		return $this->_userName;
	}

	public function getId() {
		return $this->_id;
	}

}