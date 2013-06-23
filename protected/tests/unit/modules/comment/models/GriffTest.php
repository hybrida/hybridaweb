<?php

class GriffTest extends CTestCase {

	private $user;
	private $comment;

	function setUp() {
		$this->user = Util::getUser();
		$this->comment = Util::getComment();
	}

	private function add() {
		Griff::add($this->comment->id, $this->user->id);
	}

	private function remove() {
		Griff::remove($this->comment->id, $this->user->id);
	}

	private function get() {
		return Griff::get($this->comment->id, $this->user->id);
	}

	private function assertGriffAlive() {
		$griff = $this->get();
		$this->assertNotNull($griff);
		$this->assertEquals($this->comment->id, $griff->commentId);
		$this->assertEquals(0, $griff->isDeleted);
	}

	private function assertGriffDead() {
		$griff = $this->get();
		$this->assertNotNull($griff);
		$this->assertEquals(1, $griff->isDeleted);
	}

	public function test_add() {
		$countBefore = Griff::model()->count();
		$this->add();
		$countAfter = Griff::model()->count();
		$this->assertEquals($countBefore + 1, $countAfter);
	}

	public function test_get() {
		$this->add();
		$this->assertGriffAlive();
	}

	public function test_add_multipleTimes() {
		for ($i = 0; $i < 3; $i++) {
			$this->add();
			$this->assertGriffAlive();
			$this->remove();
			$this->assertGriffDead();
		}
	}

}
