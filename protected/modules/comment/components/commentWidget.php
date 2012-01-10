<?php

class CommentWidget extends CWidget {
	public $id;
	public $type;
	public $model;
	
	public function init() {
		$this->model=  Comment::model()->find();
	}
	
	public function run() {
		
	}
}