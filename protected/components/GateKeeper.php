<?php

class GateKeeper {

	private $user;
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
		$this->access = array();
		$this->userId = null;
	}

	private function initLoggedInn() {
		$this->user = User::model()->findByPk(user()->id);
		$this->userId = $this->user->id;
		$this->access = $this->user->access;
	}
	
	public function hasAccess($type, $id) {
		$userAccess = $this->separateInGroups($this->access);
		
		$postAccess = $this->getAccessRelations($type, $id);
		if (!empty( $postAccess)) {
			if (is_array($postAccess[0])) {
				$success = false;
				foreach ($postAccess as $postAccessSubGroup) {
					$success = $success 
							|| $this->subGroupHasAccess($userAccess, $postAccessSubGroup);
				}
				return $success;
			} return $this->subGroupHasAccess($userAccess, $postAccess);
		} return true;
	}
	
	private function subGroupHasAccess($userAccess, $postAccess) {
		$postAccess = $this->separateInGroups($postAccess);
		$success = true;
		foreach ($postAccess as $groupKey => $postAccessGroup) {
			if (!array_key_exists($groupKey, $userAccess)) {
				return false;
			}
			$success = $success && $this->hasAccessOneGroup($userAccess[$groupKey], $postAccessGroup);
		}
		return $success == true;
	}
	
	private function hasAccessOneGroup($userAccess, $postAccess) {
		if (empty ($postAccess)) {
			return true;
		}
		
		$union = array_intersect($postAccess,$userAccess);
		return ! empty($union);
	}
	
	private function separateInGroups($access) {
		$array = array();
		foreach ($access as $id) {
			$i = floor($id / 1000);
			$array[$i][] = $id;
		}
		return $array;
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
	
	protected function setAccess($access) {
		$this->access = $access;
	}

}