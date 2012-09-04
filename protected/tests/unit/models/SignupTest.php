<?php

class SignupTest extends CTestCase {

	private function getSignup() {
		return Util::getSignup();
	}

	public function getUser() {
		return Util::getUser();
	}

	public function test_validate() {
		$signup = $this->getSignup();
		$validate = $signup->validate();
		if (!$validate) {
			print_r($signup->getErrors());
		}
		$this->assertTrue($signup->validate());
	}

	public function test_insert_() {
		$signup = $this->getSignup();
		$array = array(1, 2, 3);
		$signup->setAccess($array);
		$signup->save();
		$this->assertEquals($array, $signup->getAccess());
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$array = array(1, 2, 3, 4, 5);
		$signup = $this->getSignup();
		$signup->setAccess($array);
		$signup->save();

		$signup2 = Signup::model()->findByPk($signup->primaryKey);
		$this->assertEquals($array, $signup2->getAccess());
	}

	public function test_accessProperty() {
		$signup = $this->getSignup();
		$array = array(1, 2, 3, 4, 5);
		$signup->access = $array;
		$signup->save();

		$signup2 = Signup::model()->findByPk($signup->primaryKey);
		$this->assertEquals($array, $signup2->access);
	}

	public function test_accessIsLoadedOnFound() {
		$signup = $this->getSignup();
		$access = array(1, 2, 4, 5);
		$signup->access = $access;
		$signup->save();

		$signup2 = Signup::model()->findByPk($signup->primaryKey);
		$this->assertEquals($access, $signup2->access);
	}

	public function test_save_noInput_idNotNull() {
		$signup = $this->getSignup();
		$signup->save();
		$this->assertNotEquals(null, $signup->primaryKey);
	}

	public function test_addAttending_attendingCount_oneAttending() {
		$signup = $this->getSignup();
		$user = $this->getUser();
		$signup->addAttender(
				$user->id);
		$this->assertEquals(1, $signup->attendingCount);
	}

	public function test_addAttending_attendingCount_fewAttending() {
		$signup = $this->getSignup();
		$user1 = $this->getUser();
		$user2 = $this->getUser();
		$signup->addAttender($user1->id);
		$signup->addAttender($user2->id);
		$this->assertEquals(2, $signup->attendingCount);
	}

	public function test_addAttendig_attendingCount_none() {
		$signup = $this->getSignup();
		$this->assertEquals(0, $signup->attendingCount);
	}

	public function _test_addAttending_duplicatedEntry() {
		$signup = $this->getSignup();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		$signup->addAttender($user->id);
		$this->assertEquals(1, $signup->getAttendingCount());
	}

	public function test_removeAttending() {
		$signup = $this->getSignup();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		$signup->removeAttender($user->id);
		$this->assertEquals(0, $signup->attendingCount);
	}

	public function test_removeAttending_noneExisting() {
		$signup = $this->getSignup();
		$signup->removeAttender(123139817243);
	}

	public function test_getAttenderIDs() {
		$signup = $this->getSignup();
		$user1 = $this->getUser();
		$user2 = $this->getUser();
		$user3 = $this->getUser();
		$signup->addAttender($user1->id);
		$signup->addAttender($user2->id);
		$signup->addAttender($user3->id);

		$attendingArray = array(
			$user1->id, $user2->id, $user3->id,
		);
		$this->assertEquals($attendingArray, $signup->getAttenderIDs());
	}

	public function test_isAttending_true() {
		$signup = $this->getSignup();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		$this->assertTrue($signup->isAttending($user->id));
	}

	public function test_isAttending_false() {
		$signup = $this->getSignup();
		$user = $this->getUser();
		$this->assertFalse($signup->isAttending($user->id));
	}
	
	public function test_removeAttender_signoffIsFalse_nothingIsDone() {
		$signup = $this->getSignup();
		$signup->signoff = false;
		$signup->save();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		
		$this->assertEquals(1, $signup->getAttendingCount());		
		
		$signup->removeAttender($user->id);
		$this->assertEquals(1, $signup->getAttendingCount());
	}
	
	public function test_canUnattend_signoffIsFalse_false() {
		$signup = $this->getSignup();
		$signup->signoff = false;
		$signup->save();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		
		$this->assertEquals(1, $signup->getAttendingCount());
		$this->assertFalse($signup->canUnattend());
	}
	
	public function test_canUnattend_signoffIsTrue_true() {
		$signup = $this->getSignup();
		$signup->signoff = true;
		$signup->save();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		
		$this->assertEquals(1, $signup->getAttendingCount());
		$this->assertTrue($signup->canUnattend());
	}
	
		public function test_canUnattend_signoffIsFalseString_false() {
		$signup = $this->getSignup();
		$signup->signoff = "false";
		$signup->save();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		
		$this->assertEquals(1, $signup->getAttendingCount());
		$this->assertFalse($signup->canUnattend());
	}
	
	public function test_canUnattend_signoffIsTrueString_true() {
		$signup = $this->getSignup();
		$signup->signoff = "true";
		$signup->save();
		$user = $this->getUser();
		$signup->addAttender($user->id);
		
		$this->assertEquals(1, $signup->getAttendingCount());
		$this->assertTrue($signup->canUnattend());
	}

}