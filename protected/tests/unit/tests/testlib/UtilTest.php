<?php

class UtilTest extends PHPUnit_Framework_TestCase {

	private function assertSave($object) {
		$this->assertTrue($object->save(), "Kunne ikke lagre modell: ". print_r($object->errors, true));
	}

	public function testGetNewNews() {
		$this->assertSave(Util::getNewNews());
	}

	public function testGetNewEvent() {
		$this->assertSave(Util::getNewEvent());
	}

	public function testGetNewSignup() {
		$this->assertSave(Util::getNewSignup());
	}
	public function testGetNewUser() {
		$this->assertSave(Util::getNewUser());
	}

	public function testGetNewGroup() {
		$this->assertSave(Util::getNewGroup());
	}

	public function testGetNewArticle() {
		$this->assertSave(Util::getNewArticle());
	}
	
	public function testGetNewFacebookUser() {
		$this->assertSave(Util::getNewFacebookUser(Util::getUser()->id));
	}
	
	public function testGetNewComment() {
		$this->assertSave(Util::getNewComment());
	}
	
	public function testGetNewArticleText() {
		$dummyArticleId = 0;
		$this->assertSave(Util::getNewArticleText($dummyArticleId));
	}

	public function testGetNewSignupMembershipAnonym() {
		$event = Util::getEvent();
		$this->assertSave(Util::getNewSignupMembershipAnonymous($event->id));
	}


}
