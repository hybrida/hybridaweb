<?php

class CommentWidget extends CWidget {
	public $id = "";
	public $type = "";
	public $model;
	
	public function init() {
		$this->throwExceptionIfNoInput();
		$this->model = Comment::model()->findAll("parentId = :id AND parentType = :type",array(
			":id" => $this->id,
			":type" => $this->type,
		));
	}
	
	private function throwExceptionIfNoInput() {
		if ($this->id == "" || $this->type == "") {
			throw new CException("paramter ID eller TYPE er ikke definert");
		}
	}
	
	public function run() {
		$this->render("view",array(
			'models' => $this->model,
		));
	}
}