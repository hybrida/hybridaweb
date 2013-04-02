<?php

class SignupMembershipManualForm extends CFormModel {

	public $username;
	private $signup;
	public $delete = array();

	public function __construct($signup) {
		$this->signup = $signup;
	}

	public function save() {
		$this->addNewAttenders();
		$this->deleteAttenders();
	}

	private function addNewAttenders() {
		$user = User::model()->find('username = :username', array(
			'username' => $this->username
		));
		if (!$user) return false;

		$this->signup->addAttender($user->id);
	}

	public function deleteAttenders() {
		foreach ($this->delete as $userId => $shouldDelete) {
			if ($shouldDelete == 1) {
				$this->signup->removeAttender($userId);
			}
		}
	}

}