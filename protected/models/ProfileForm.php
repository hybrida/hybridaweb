<?php

class ProfileForm extends CFormModel {

	private $_user;
	public $user;
	public $facebookUser;
	private $_facebookUser;
	
	public $imageUpload;

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

	public function getFacebookUserModel() {
		return $this->_facebookUser;
	}

	public function setAttributes($values, $safeOnly = false) {
		unset($values['member']);
		parent::setAttributes($values, $safeOnly);
	}

	public function save() {
		$this->saveUser();
		$this->saveFacebookUser();
	}

	private function saveUser() {
		$user = $this->_user;
		$this->_user->setAttributes($this->user);
		$this->_user->purify();
		$this->_user->save();
		try {
			$image = Image::uploadByModel($this, 'imageUpload', $user->id);
			$user->imageId = $image->id;
			$user->save();
		} catch (NoFileIsUploadedException $ex) {
			
		}
	}

	private function saveFacebookUser() {
		if ($this->_facebookUser !== null) {
			$this->_facebookUser->setAttributes($this->facebookUser);
			$this->_facebookUser->save();
		}
	}

}
