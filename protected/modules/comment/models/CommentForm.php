<?php

class CommentForm extends CFormModel {
	public $id = "";
	public $type = "";
	public $content = "";
	public $author  = "";
	public $timestamp = "";
	
	public function __construct($type, $id, $scenario = '') {
		parent::__construct($scenario);
		$this->type = $type;
		$this->id = $id;
		
	}
	
	public function rules() {
		return array(
			array(
				'id,type,content, author, timestamp', 'default'
			),
		);
	}
	
	public function trace() {
		echo "<pre>";
		echo $this->id;
		echo $this->type;
		echo $this->content;
		echo $this->author;
		echo $this->timestamp;
	}
	
	public function save() {
		$comment = new Comment;
		$comment->parentId = $this->id;
		$comment->parentType = $this->type;
		$comment->content = $this->content;
		$comment->save(false);
	}
}