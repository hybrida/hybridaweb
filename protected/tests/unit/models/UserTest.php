<?php

class UserTest extends CTestCase {

	private $name = "sigurd";

	public function setUp() {
	}

	private function getCleanUserObject() {
		$user = new User;
		$user->username = "t".User::model()->count();
		$user->firstName = "UserTest";
		$user->lastName = "getCleanUserObject";
		$user->member = "false";
		return $user;
	}

	public function testUserIsCreatedWithInsert() {
		$user = $this->getCleanUserObject();
		$user->insert();

		$this->assertNotEquals(null, $user->id);
	}
	
	public function testUserIsCreatedWithSave() {
		$user = $this->getCleanUserObject();
		$user->save();
		
		$this->assertNotEquals(null, $user->id);
	}
	
	public function testUserIsValidated() {
		$user = $this->getCleanUserObject();
		$this->assertTrue($user->validate());
	}

	public function testUserHasAccessProperty() {
		$user = new User;
		$this->assertTrue($user->hasProperty("access"));
	}

	public function testUserAccess() {
		$user1 = $this->getCleanUserObject();

		$access = array(7, 8, 9, 10);
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
	
	
	public function test_setAccess_getAccess() {
		$access = array(1,2,3,4);
		$user = $this->getCleanUserObject();
		$user->setAccess($access);
		$user->save();
		
		$user2 = User::model()->findByPk($user->id);
		$this->assertEquals($access, $user2->getAccess());
	}

}
