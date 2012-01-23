<?php

class CommentWidget extends CWidget {
	public $id = "";
	public $type = "";
	public $author = "";
	public $timestamp = "";
	public $models;
	private $formModel;
	
	public function init() {
		$this->throwExceptionIfNoInput();
		$this->models = Comment::model()->findAll("parentId = :id AND parentType = :type",array(
			":id" => $this->id,
			":type" => $this->type,
		));
		$this->formModel = new CommentForm($this->type, $this->id);
	}
	
	private function throwExceptionIfNoInput() {
		if ($this->id == "" || $this->type == "") {
			throw new CException("paramter ID eller TYPE er ikke definert");
		}
	}
	
	public function run() {
		$this->render("view",array(
			'models' => $this->models,
			'formModel' => $this->formModel,
			'id' => $this->id,
			'type' => $this->type,
		));
	}
}