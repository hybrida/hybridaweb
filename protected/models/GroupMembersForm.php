<?php

class GroupMembersForm extends CFormModel {

	private $_group;
	public $add;
	public $delete;

	public function __construct($group) {
		$this->_group = $group;
	}

	public function save() {
		$this->add();
		$this->delete();
	}

	public function add() {
		if (!$this->add)
			return;
		$memberships = $this->add;
		foreach ($memberships as $ms) {
			$username = $ms['username'];
			$comission = $ms['comission'];
			if ($username == "") continue;
			$user = User::model()->find("username = :username", array(
				"username" => $username));
			if (!$user)
				return;
			$this->_group->addMember($user->id, $comission);
		}
	}

	public function delete() {
		if (!is_array($this->delete)) {
			return;
		}
		foreach ($this->delete as $userId => $shouldDelete) {
			if ($shouldDelete == 1) {
				$this->_group->removeMember($userId);
			}
		}
	}

	public function setAttributes($values, $safeOnly = false) {
		parent::setAttributes($values, $safeOnly);
	}

}