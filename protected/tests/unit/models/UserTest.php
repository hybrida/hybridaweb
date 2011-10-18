<?php

/**
 * @author Sigurd Holsen
 */
class UserTest extends PHPUnit_Framework_TestCase {
	
	private $name = "sigurd";
	
	public function setUp() {
		$user = User::model()->find("username = :username",array("username" => $this->name));
		if ($user) {
			$user->delete();
		}
	}

	public function testCreate() {
		$this->setUp();
		$user = new User;
		$user->username = $this->name;
		$user->firstName = "Geir";
		$user->lastName = "Hjelstend";
		$user->member = false;
		$user->insert();
		$this->assertNotEquals(null,$user->id);
	}
	
	
	
}
