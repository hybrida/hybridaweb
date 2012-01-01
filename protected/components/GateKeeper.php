<?php

class GateKeeper {

	private $userId;
	private $access;
	private $isGuest;

	public function __construct() {
		$this->isGuest = Yii::app()->user->isGuest;
		if ($this->isGuest) {
			$this->initLoggedOut();
		} else {
			$this->initLoggedInn();
		}
	}

	private function initLoggedOut() {
		$this->userId = null;
		$this->access = array();
	}

	private function initLoggedInn() {
		$this->userId = Yii::app()->user->id;
		$this->access = Yii::app()->user->access;
		sort($this->access);
	}

	public function hasAccess($type, $id) {
		$access = $this->getAccessRelations($type, $id);
		
		if (empty ($access)) {
			return true;
		}
		
		$union = array_intersect($this->access,$access);
		if (empty($union)) {
			return false;
		}
		return true;
	}
	
	private function getAccessRelations($type,$id) {
		$accessRelation = new AccessRelation($type, $id);
		return $accessRelation->get();
	}
	
	public function isGuest() {
		return $this->isGuest;
	}
	
	public function getUserAccess() {
		return $this->access;
	}
	
	public function getUserId() {
		return $this->userId;
	}

}