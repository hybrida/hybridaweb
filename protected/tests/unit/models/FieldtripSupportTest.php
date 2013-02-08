<?php

class FieldtripSupportTest extends CTestCase {

	private function assertSupport($expected, $user) {
		$this->assertEquals($expected, FieldtripSupport::canSupport($user));
	}

	public function test_canSupport_freshman_false() {
		$user = Util::getUser();
		$user->classYear = 1;
		$user->save();
		$this->assertSupport(false, $user);
	}

	public function test_canSupport_thirdYear_true() {
		$user = Util::getUser();
		$user->classYear = 3;
		$user->save();
	}

	public function test_isFieldtripOnYear_2012_true() {
		$this->assertTrue(FieldtripSupport::isFieldtripOnYear(2012));
	}

	public function test_isFieldtripOnYear_2013_false() {
		$this->assertFalse(FieldtripSupport::isFieldtripOnYear(2013));
	}
	
}