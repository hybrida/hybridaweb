<?php

class CommentForm extends CFormModel {

	public $id = "";
	public $type = "";
	public $content = "";
	public $author = "";
	public $timestamp = "";

	private $commentID = null;

	public function rules() {
		return array(
			array(
				'id,type,content, author, timestamp', 'default'
			),
		);
	}

	public function save() {
		$purifier = new CHtmlPurifier;
		$comment = new Comment;
		$comment->setAttributes(array(
			'parentId' => $this->id,
			'parentType' => $this->type,
			'content' => $purifier->purify($this->content),
			'authorId' => user()->id,
			'timestamp' => new CDbExpression('NOW()'),
		));
		$comment->save();
		$this->commentID = $comment->id;
	}

	public function getCommentID() {
		return $this->commentID;
	}

}