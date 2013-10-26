<?php


class TrackerUserTest extends CTestCase {


	public function test_userRelation() {
		$user = Util::getTrackerUser();
		$id1 = $user->user_id;

		$id2 = $user->user->id;

		$this->assertEquals($id1, $id2);
	}

}
