<?php

/**
 * @author Sigurd Holsen
 */
class UserTest extends PHPUnit_Framework_TestCase {

	private $name = "sigurd";

	public function setUp() {
		$this->deleteUserIfFound();
	}

	private function getRandomUserObject() {
		$user = new User;
		$user->username = "sigurd" . rand(0,1000);
		$user->firstName = "Sigurd";
		$user->lastName = "Holsen";
		$user->member = false;
		return $user;
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

	public function testUserAccess() {
		$user1 = $this->getRandomUserObject();

		$access = array(7,8,9,10);
		$user1->access = $access;
		$user1->insert();
		
		$user2 = User::model()->findByPk($user1->id);
		

		$this->assertEquals($access, $user2->access);
	}

	public function testSetterAndGetterForAccessProperty() {
		$model = new User;
		$array = array(1, 2, 3);
		$model->access = array(1, 2, 3);
		$this->assertEquals($array, $model->access);
	}

	public function testSetterAndGetterForAccess() {
		$model = new User;
		$array = array(1, 2, 3);
		$model->setAccess($array);
		$this->assertEquals($array, $model->getAccess());
	}

}
