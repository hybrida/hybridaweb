<?php

class InnsidaIdentityTest extends CTestCase {

	private $user;

	public function setUp() {
		$this->user = $this->getNewUser();
	}

	private function getNewUser() {
		$user = new User;
		$user->username = 'sh' . User::model()->count();
		$user->lastName = 'TestCase';
		$user->firstName = 'TestCase';
		$user->member = "false";
		$user->save();
		$this->assertFalse($user->isNewRecord);
		return $user;
	}

	private function getDefaultIdentity() {
		$data = "id,blabla,skole,blabla,username,sigurhol,yndlingsfarge,grønn";
		$sso = new SSOMock($data);
		$identity = new InnsidaIdentity($sso);
		return $identity;
	}

	public function test_mockObject() {
		$username = $this->user->username;
		$data = "id,23,username,$username";
		$mock = new SSOMock($data);
		$this->assertEquals($username, $mock->loginvalues['username']);
	}

	public function test_getName() {
		$identity = $this->getDefaultIdentity();
		$name = $identity->getName();
		$this->assertEquals("sigurhol", $name);
	}

	public function test_getStates() {
		$user = $this->user;
		$username = $this->user->username;
		$data = "username,$username";
		$mock = new SSOMock($data);
		$identity = new InnsidaIdentity($mock);

		$this->assertEquals($user->firstName, $identity->getState('firstName'));
		$this->assertEquals($user->middleName, $identity->getState('middleName'));
		$this->assertEquals($user->lastName, $identity->getState('lastName'));
		$this->assertEquals($user->member, $identity->getState('member'));
		$this->assertEquals($user->gender, $identity->getState('gender'));
		$this->assertEquals($user->imageId, $identity->getState('imageId'));
	}

	public function test_getId() {
		$user = $this->user;
		$data = "username,$user->username";
		$mock = new SSOMock($data);
		$identity = new InnsidaIdentity($mock);
		$this->assertEquals($user->id, $identity->getId());
	}

	public function test_nonExistingUser() {
		$data = "username,arst1234";
		$mock = new SSOMock($data);
		$identity = new InnsidaIdentity($mock);
		$this->assertFalse($identity->authenticate());
	}

	public function test_existingUser() {
		$data = "username,{$this->user->username}";
		$mock = new SSOMock($data);
		$identity = new InnsidaIdentity($mock);
		$this->assertTrue($identity->authenticate());
	}

	public function test_lastLoginIsUpdated() {
		$user = $this->getNewUser();
		
		$data = "username,{$user->username}";
		$mock = new SSOMock($data);

		$user->lastLogin = '';
		$user->save();
		$user2 = User::model()->findByPk($user->id);
		$old = $user2->lastLogin;

		$identity = new InnsidaIdentity($mock);
		$this->assertTrue($identity->authenticate());
		
		$new = User::model()->findByPk($user->id)->lastLogin;
		$this->assertNotEquals($old, $new);
	}

}

class SSOMock {

	public $loginvalues;

	function __construct($data) {
		$this->loginvalues = array();

		// parse the data-field
		$dataar = explode(",", $data);
		while ($k = array_shift($dataar)) {
			$this->loginvalues[$k] = array_shift($dataar);
			// if this value is a list
			if (strstr($this->loginvalues[$k], ":")) {
				$this->loginvalues[$k] = explode(":", $this->loginvalues[$k]);
			}
		}
	}

	function verifies() {
		return true;
	}

	function oktime() {
		return true;
	}

	function okip() {
		return true;
	}

	function oktarget() {
		return true;
	}

	function loginvalues() {
		return $this->loginvalues;
	}

	function reason() {
		return "";
	}

	function oklogin() {
		return true;
	}

}
