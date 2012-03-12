<?php

class CommentForm extends CFormModel {

	public $id = "";
	public $type = "";
	public $content = "";
	public $author = "";
	public $timestamp = "";

	public function rules() {
		return array(
			array(
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
					'timestamp' => 'NOW()',
				));
	}

}