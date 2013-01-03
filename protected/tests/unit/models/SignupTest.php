<?php

class SignupTest extends CTestCase {

	private function getSignup() {
		return Util::getSignup();
	}

	private function getSignupWithAttenders($usernames) {
		$signup = Util::getNewSignup();
		
		foreach ($usernames as $name => $class) {
			$user = $this->getUser();
			
			if (!(preg_match('/\s/',$name))) {
				$user->firstName = $name;
			} else {
				$names = explode(" ", $name);
				$user->firstName = $names[0];
				$user->lastName = $names[1];
			}
			
			$user->classYear = $class;
			$user->save();
			$signup->addAttender($user->id ,false);
		}
		
		return $signup;
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

	public function test_get_attenders_five_year_arrays() {
		$usernames = array(
			"Albert" => 1,
			"Christian" => 1,
			"Beta" => 1,
			"Arne" => 2,
			"Anne" => 2,
			"Adam" => 2,
			"Anita" => 2,
			"Anne Hei" => 3,
			"Anne Nei" => 3,
			);
		
		$signup = $this->getSignupWithAttenders($usernames);
		$attenders = $signup->attendersFiveYearArrays;

		$this->assertEquals($attenders[0][0]->firstName, "Albert");
		$this->assertEquals($attenders[0][1]->firstName, "Beta");
		$this->assertEquals($attenders[0][2]->firstName, "Christian");
		$this->assertEquals($attenders[1][0]->firstName, "Adam");
		$this->assertEquals($attenders[1][1]->firstName, "Anita");
		$this->assertEquals($attenders[1][2]->firstName, "Anne");
		$this->assertEquals($attenders[1][3]->firstName, "Arne");
		
		$this->assertEquals($attenders[2][0]->lastName, "Hei");
		$this->assertEquals($attenders[2][1]->lastName, "Nei");
	}

	public function test_anonymousAttenders() {
		$event = Util::getEvent();
		$signup = Util::getSignup($event->id);
		$signup->addAnonymousAttender("Sigurd Andreas", "Holsen", "sighol@gmail.com");
		$this->assertEquals(1, $signup->getAttendingCount());

		$signup->removeAllAttenders();
		$this->assertEquals(0, $signup->getAttendingCount());

		$anonymousAttenders = $signup->getAnonymousAttenders();
		$this->assertEquals(1, count($anonymousAttenders));
	}

	public function test_addAnonymousAttenderAndDeleteHim_databasRecordIsNotDeleted() {

	}
}