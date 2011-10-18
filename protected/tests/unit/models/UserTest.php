<?php

/**
 * @author Sigurd Holsen
 */
class UserTest extends PHPUnit_Framework_TestCase {

	private $name = "sigurd";
	
	public function setUp() {
		$this->deleteUserIfFound();
	}

	private function deleteUserIfFound() {
		$user = User::model()->find("username = :username", array(":username" => $this->name));
		if ($user) {
			$user->delete();
		}
	}

	public function testSetUpMethod() {
		$user = User::model()->find("username=:username", array(":username" => $this->name));
		$this->assertEquals(null, $user);
	}
	

	public function testUserIsCreated() {
		$user = new User;
		$user->username = $this->name;
		$user->firstName = "Sigurd";
		$user->lastName = "Holsen";
		$user->member = false;
		
		$user->insert();
		$user->save();

		$this->assertNotEquals(null, $user->id);
	}
	
	public function testUserHasAccessProperty() {
		$user = new User;
		$this->assertTrue($user->hasProperty("access"));
	}
	
	public function tearDown() {
		$this->deleteUserIfFound();
	
	}
	
	public function testUserHasAccess() {
		$user = new User;
		$user->username = rand(0,10000);
		$user->firstName = "dummy";
		$user->lastName = "Please delete me";
		$user->member = false;
		
		$user->insert();
		
		$this->assertNotEquals(null, $user->id);
		$accessArray = array(1,2,3,4,5);
		Access::insertAccessRelationArray("event", $user->id, $accessArray);
		$this->assertEquals($accessArray, $user->access);
		
	}

}
