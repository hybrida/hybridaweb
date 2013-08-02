<?php

class CommentTest extends CTestCase {


	public function test_delete_existing() {
		$comment = Util::getComment();
		$comment->delete();

		$comment2 = Comment::model()->findByPk($comment->id);
		$this->assertEquals("true", $comment2->isDeleted);
	}

	public function test_create_timestampIsNow() {
		$comment = Util::getComment();
		$this->assertNotNull($comment->timestamp);
	}

	public function test_create_authorIsSet() {
		$sess = new Session;
		$sess->loginNewUser();
		$comment = Util::getComment();
		$this->assertEquals(user()->id, $comment->authorId);
	}

	public function test_relations_author() {
		$sess = new Session;
		$sess->loginNewUser();
		$comment = Util::getComment();
		$this->assertEquals(user()->id, $comment->author->id);
	}

}