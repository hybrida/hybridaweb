<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author sigurd
 */
class Session {

	public function login($id) {
		$identity = new DefaultIdentity($id);
		if ($identity->authenticate()) {
			Yii::app()->user->login($identity);
		} else {
			$this->throwLoginError();
		}
	}

	private function throwLoginError() {
		throw new Exception("Could Not Log in");
	}

	private function getNumberOfUsers() {
		return User::model()->count();
	}

	public function loginNewUser($access=array()) {
		$user = new User;
		$user->username = "u".$this->getNumberOfUsers();
		$user->firstName = "TestCase";
		$user->lastName = "TestCase";
		$user->member = "true";

		//$user->setAccess($access);
		$user->save();

		$userIdentity = new DefaultIdentity($user->id); // Sigurd
		if ($userIdentity->authenticate()) {
			Yii::app()->user->login($userIdentity);
		} else {
			$this->throwLoginError();
		}
	}

	public function logout() {
		Yii::app()->user->logout();
		if (!Yii::app()->user->isGuest) {
			throw new Exception("Brukeren burde vært logget ut, men er det ikke");
		}
	}

}