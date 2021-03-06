<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
Yii::import('application.tests.mocks.SSOMock');

class DefaultIdentity extends InnsidaIdentity {

	public function __construct($id) {
		$user = null;
		if (is_numeric($id)) {
			$user = User::model()->findByPk($id);
		} else {
			$user = User::findByUsername($id);
		}

		$ssoClient = new SSOMock("username,{$user->username}");
		parent::__construct($ssoClient);
	}

}