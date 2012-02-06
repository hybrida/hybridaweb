<?php

Yii::import('comment.components.*');
Yii::import('comment.models.*');

class CommentWidget extends CWidget {

	public $id = "";
	public $type = "";
	public $author = "";
	public $timestamp = "";
	public $width = 400;
	public $height = 130;
	public $models;
	private $formModel;

	public function init() {
		$this->throwExceptionIfNoInput();
		$this->models = Comment::model()->findAll("parentId = :id AND parentType = :type", array(
			":id" => $this->id,
			":type" => $this->type,
				));
		$this->formModel = new CommentForm();
		$this->formModel->id = $this->id;
		$this->formModel->type = $this->type;
	}

	private function throwExceptionIfNoInput() {
		if ($this->id == "" || $this->type == "") {
			throw new CException("paramter ID eller TYPE er ikke definert");
		}
	}

	public function run() {
		if (!user()->isGuest) {
			$this->render("member", array(
				'models' => $this->models,
				'formModel' => $this->formModel,
				'width' => $this->width,
				'height' => $this->height,
			));
		} else {
			$this->render('guest');
		}
	}

}