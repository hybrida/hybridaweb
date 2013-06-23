<?php

Yii::import('comment.components.*');
Yii::import('comment.models.*');

class CommentWidget extends CWidget {

	public $id = "";
	public $type = "";
	private $formModel;
	
	private $comments;
	
	private $griffCount;
	private $griffed;

	public function init() {
		$this->throwExceptionIfNoInput();
		$this->formModel = new CommentForm();
		$this->formModel->id = $this->id;
		$this->formModel->type = $this->type;
		$this->comments = Comment::getAll($this->type, $this->id);
		$this->initGriffData();
	}

	private function throwExceptionIfNoInput() {
		if ($this->id == "" || $this->type == "") {
			throw new CException("paramter ID eller TYPE er ikke definert");
		}
	}

	private function initGriffData() {
		$this->initGriffCount();
		$this->initGriffed();
	}

	public function initGriffCount() {
		$this->griffCount = array();
		$sql = "SELECT comment.id, COUNT(griff.id) as count
				FROM comment
				JOIN griff on griff.commentId = comment.id
				WHERE comment.parentId = :id AND
					comment.parentType = :type AND
					griff.isDeleted = 0
				GROUP BY comment.id";
		
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->bindValue("id", $this->id);
		$stmt->bindValue("type", $this->type);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $d) {
			$this->griffCount[$d['id']] = $d['count'];
		}
	}
	
	public function initGriffed() {
		$this->griffed = array();
		$sql = "SELECT comment.id, griff.userId
				FROM comment
				join griff on griff.commentId = comment.id
				where comment.parentType = :type AND
					comment.parentId = :id AND
					griff.isDeleted = 0";
		
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->bindValue("id", $this->id);
		$stmt->bindValue("type", $this->type);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $d) {
			$ids = array();
			if (isset($this->griffed[$d['id']])) {
				$ids = $this->griffed[$d['id']];
			}
			$ids[] = (int)$d['userId'];
			$this->griffed[$d['id']] = $ids;
		}
	}

	public function run() {
		if (!user()->isGuest) {
			$this->render("member", array(
				'formModel' => $this->formModel,
				'comments' => $this->comments,
			));
		} else {
			$this->render('guest');
		}
	}

	public function userHasGriffed($comment) {
		if( isset($this->griffed[$comment->id])) {
			$ids = $this->griffed[$comment->id];
			return (in_array(user()->id, $ids));
		}
	}

	public function userHasGriffedClass($comment) {
		if ($this->userHasGriffed($comment)) {
			return "c-userHasGriffed";
		}
		return "";
	}

	public function getGriffCount($comment) {
		if (isset($this->griffCount[$comment->id])) {
			return $this->griffCount[$comment->id];
		}
		return 0;
	}

}