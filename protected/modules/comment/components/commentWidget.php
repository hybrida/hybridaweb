<?php

Yii::import('comment.components.*');
Yii::import('comment.models.*');

class CommentWidget extends CWidget {

	public $id = "";
	public $type = "";
	private $formModel;

	public function init() {
		$this->throwExceptionIfNoInput();
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
				'formModel' => $this->formModel,
			));
		} else {
			$this->render('guest');
		}
	}

}