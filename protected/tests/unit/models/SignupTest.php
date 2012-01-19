<?php

class SignupTest extends CTestCase {

	public function getSignupObject() {
		$signup = new Signup;
		$signup->spots = 1;
		$signup->close = "2011.10.22 14:30";
		$signup->open = "2011.10.22 14:30";
		$signup->eventId = rand(1000, 10000000);
		return $signup;
	}

	public function getUser() {
		// username, firstName, lastName, member
		$user = new User;
		$user->username = 'test' . User::model()->count();
		$user->firstName = $user->lastName = "test";
		$user->member = "true";
		$this->assertTrue($user->save());
		return $user;
	}

	public function test_validate() {
		$signup = $this->getSignupObject();
		$validate = $signup->validate();
		if (!$validate) {
			print_r($signup->getErrors());
		}
		$this->assertTrue($signup->validate());
	}

	public function test_insert_() {
		$signup = $this->getSignupObject();
		$array = array(1, 2, 3);
		$signup->setAccess($array);
		$signup->save();
		$this->assertEquals($array, $signup->getAccess());
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$array = array(1, 2, 3, 4, 5);
		$signup = $this->getSignupObject();
		$signup->setAccess($array);
		$signup->save();

		$signup2 = Signup::model()->findByPk($signup->primaryKey);
		$this->assertEquals($array, $signup2->getAccess());
	}

	public function test_accessProperty() {
		$signup = $this->getSignupObject();
		$array = array(1, 2, 3, 4, 5);
		$signup->access = $array;
		$signup->save();

		$signup2 = Signup::model()->findByPk($signup->primaryKey);
		$this->assertEquals($array, $signup2->access);
	}

	public function test_accessIsLoadedOnFound() {
		$signup = $this->getSignupObject();
		$access = array(1, 2, 4, 5);
		$signup->access = $access;
		$signup->save();

		$signup2 = Signup::model()->findByPk($signup->primaryKey);
		$this->assertEquals($access, $signup2->access);
	}

	public function test_save_noInput_idNotNull() {
		$signup = $this->getSignupObject();
		$signup->save();
		$this->assertNotEquals(null, $signup->primaryKey);
	}

	public function test_addAttending_attendingCount_oneAttending() {
		$signup = $this->getSignupObject();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		$this->assertEquals(1, $signup->attendingCount);
	}

	public function test_addAttending_attendingCount_fewAttending() {
		$signup = $this->getSignupObject();
		$user1 = $this->getUser();
		$user2 = $this->getUser();
		$signup->addAttender($user1->id);
		$signup->addAttender($user2->id);
		$this->assertEquals(2, $signup->attendingCount);
	}

	public function test_addAttendig_attendingCount_none() {
		$signup = $this->getSignupObject();
		$this->assertEquals(0, $signup->attendingCount);
	}

	public function test_removeAttending() {
		$signup = $this->getSignupObject();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		$signup->removeAttender($user->id);
		$this->assertEquals(0, $signup->attendingCount);
	}

	public function test_removeAttending_noneExisting() {
		$signup = $this->getSignupObject();
		$signup->removeAttender(123139817243);
	}

}
