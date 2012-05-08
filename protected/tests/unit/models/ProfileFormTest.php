<?php

class ProfileFormTest extends PHPUnit_Framework_TestCase {

	private $input_firstNameChange = array(
		'user' => array(
			'lastName' => 'test-test',
		)
	);
	private $input_full = array(
		'user' => array(
			'lastName' => 'test-test',
		), 'facebookUser' => array(
			'postEvents' => true,
		),
	);

	private function getForm($user) {
		return new ProfileForm($user);
	}

	private function getNewFbUser(User $user) {
		return Util::getNewFacebookUser($user->id);
	}

	private function getFbUser(User $user) {
		$fbUser = $this->getNewFbUser($user);
		$this->assertTrue($fbUser->save());
		return $fbUser;
	}

	public function test_create() {
		$user = Util::getUser();
		$form = $this->getForm($user);
		$this->assertEquals($user, $form->getUserModel());
	}

	public function test_create_noFacebook_fieldsAreSet() {
		$userModel = Util::getUser();
		$form = $this->getForm($userModel);
		$userArray = $form->user;
		$this->assertEquals($userModel->firstName, $userArray['firstName']);
		$this->assertEquals($userModel->lastName, $userArray['lastName']);
	}

	public function test_create_withFacebook_fieldsAreSet() {
		$user = Util::getUser();
		$facebookUser = Util::getFacebookUser($user->id);
		$form = $this->getForm($user);
		$this->assertEquals($facebookUser->postEvents, $form->facebookUser['postEvents']);
	}

	public function test_insert_userData_userDataFieldsAreUpdated() {
		$user = Util::getUser();
		$form = $this->getForm($user);
		$input = array(
			'user' => array(
				'firstName' => "test-test",
			)
		);
		$form->setAttributes($input);
		$this->assertEquals("test-test", $form->user['firstName']);
	}

	public function test_insert_userDataAndNewFacebookData_userDataAndFacebookDataFieldsAreUpdated() {
		$user = Util::getUser();
		$input = array(
			'user' => array(
				'lastName' => 'testLastname',
			),
			'facebookUser' => array(
				'postEvents' => true,
			),
		);
		$form = $this->getForm($user);
		$form->setAttributes($input);
		$this->assertEquals($input['facebookUser']['postEvents'], $form->facebookUser['postEvents']);
		$this->assertEquals($input['user']['lastName'], $form->user['lastName']);
	}

	public function test_save_userData() {
		$user = Util::getUser();
		$form = $this->getForm($user);
		$input = $this->input_firstNameChange;
		$form->setAttributes($input);
		$form->save();

		$user = User::model()->findByPk($user->id);
		$this->assertEquals($input['user']['lastName'], $user->lastName);
	}

	public function test_save_userDataAndFacebookdata_facebookDataGetsUpdated() {
		$user = Util::getUser();
		$face = Util::getFacebookUser($user->id);
		$this->assertEquals('false', $face->postEvents);
		$form = $this->getForm($user);
		$input = $this->input_full;
		$form->setAttributes($input);
		$form->save();

		$face = FacebookUser::model()->findByPk($face->userId);
		$this->assertEquals("true", $face->postEvents);
	}

	public function test_save_xssAttack_getsPurified() {
		$user = Util::getUser();
		$input = array(
			'user' => array(
				'lastName' => 'testLastname<script></script>',
				'description' => "<script></script>description",
			),
			'facebookUser' => array(
				'postEvents' => true,
			),
		);
		$form = $this->getForm($user);
		$form->setAttributes($input);
		$form->save();
		$user = User::model()->findByPk($user->id);
		$this->assertEquals("testLastname", $user->lastName);
		$this->assertEquals("description", $user->description);
	}

	public function test_create_getFacebookUserModel() {
		$user = Util::getUser();
		$face = Util::getFacebookUser($user->id);
		$form = $this->getForm($user);
		$this->assertEquals($face->fb_token, $form->getFacebookUserModel()->fb_token);
	}

	public function test_insert_illegalKey_throwsIllegalException() {
		$user = Util::getUser();
		$form = $this->getForm($user);
		$form->setAttributes(array(
			'oaeitnf' => 'aotat',
			'user' => array(
				'bla bla',
			)
		));
	}
	
}
