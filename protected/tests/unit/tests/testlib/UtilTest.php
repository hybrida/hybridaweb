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

	public function testGetNewQuizTeam() {
		$team = Util::getNewQuizTeam();
		$this->assertSave($team);
	}

	public function testGetNewQuizEvent() {
		$team = Util::getQuizTeam();
		$this->assertSave(Util::getNewQuizEvent($team->id));
	}

	public function testGetNewQuizTeamScore() {
		$team = Util::getQuizTeam();
		$event = Util::getQuizEvent($team->id);
		$score = Util::getNewQuizTeamScore($event->id, $team->id);

		$this->assertSave($score);
	}

	public function testGetNewTrackerUser () {
		$this->assertSave(Util::getNewTrackerUser());
	}

	public function testGetTrackerUser() {
		$user = Util::getTrackerUser();
		$this->assertFalse($user->isNewRecord);
	}

	public function testGetNewTrackerLog() {
		$this->assertSave(Util::getNewTrackerLog());
	}

	public function testGetTrackerLog() {
		$log = Util::getTrackerLog();
		$this->assertFalse($log->isNewRecord);
	}

}
