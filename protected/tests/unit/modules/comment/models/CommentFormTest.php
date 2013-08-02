<?php

Yii::import('comment.models.*');

/*
 * array(
				'id,type,content, author, timestamp', 'default'
			),
		);
	}

	public function save() {
		$purifier = new CHtmlPurifier;
		Yii::app()->db->createCommand()
				->insert('comment', array(
					'parentId' => $this->id,
					'parentType' => $this->type,
					'content' => $purifier->purify($this->content),
					'authorId' => user()->id,
					'timestamp' => new CDbExpression('NOW()'),
 */
class CommentFormTest extends CTestCase {

	public function test_commentIdGetsSaved() {
		$commentForm = new CommentForm;
		$commentForm->setAttributes(array(
			'id' => 20,
			'type' => 'news',
			'content' => 'helloWorld',
		));
		$numberOfCommentsBeforeSave = Comment::model()->count();
		$commentForm->save();
		$numberOfCommentsAfterSave = Comment::model()->count();
		$this->assertEquals($numberOfCommentsBeforeSave + 1, $numberOfCommentsAfterSave);

		$this->assertNotNull($commentForm->commentID);

	}

}