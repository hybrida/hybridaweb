<?php

class SignupMembershipAnonymousTest extends CTestCase {

	private $sm;

	function setup() {
		$this->sm = new SignupMembershipAnonymous();
	}

	public function test_create_timestampIsSet_currentTimestamp() {
		$this->assertNotNull($this->sm->timestamp);
	}

}
