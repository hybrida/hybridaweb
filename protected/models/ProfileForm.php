<?php

class ProfileForm extends CFormModel {

	private $_user;
	public $user;
	public $facebookUser;
	private $_facebookUser;

	public function __construct($user) {
		$this->_user = $user;
		$this->setFields();
	}

	private function setFields() {
		$this->user = $this->_user->getAttributes();
		$this->setFacebookFields();
	}

	private function setFacebookFields() {
		$this->_facebookUser = FacebookUser::model()->findByPk($this->_user->id);
		if ($this->_facebookUser !== null) {
			$this->facebookUser = $this->_facebookUser->getAttributes();
		}
	}

	public function getUserModel() {
		return $this->_user;
	}

	public function setAttributes($values) {
		foreach ($values as $key => $value) {
			$this->$key = $value;
		}
	}

	public function save() {
		$this->_user->setAttributes($this->user);
		$this->_user->save();
		if ($this->_facebookUser !== null) {
			$this->_facebookUser->setAttributes($this->facebookUser);
			$this->_facebookUser->save();
		}
	}

}
