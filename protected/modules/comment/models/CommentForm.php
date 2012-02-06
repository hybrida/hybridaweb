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
		Yii::app()->db->createCommand()
				->insert('hyb_comment', array(
					'parentId' => $this->id,
					'parentType' => $this->type,
					'content' => $this->content,
					'authorId' => user()->id,
					'timestamp' => 'NOW()',
				));
	}

}