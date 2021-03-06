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

	public function hasPostAccess($type, $id) {
		$userAccess = $this->separateInAccessIntervals($this->access);
		$postAccess = $this->getAccessRelations($type, $id);
		if (!empty($postAccess)) {
			if ($this->doesAccessHaveSuperGroups($postAccess)) {
				return $this->someSuperGroupsHasAccess($userAccess, $postAccess);
			} return $this->superGroupHasAccess($userAccess, $postAccess);
		} return true;
	}

	private function doesAccessHaveSuperGroups($postAccess) {
		return is_array($postAccess[0]);
	}

	private function someSuperGroupsHasAccess($userAccess, $postAccess) {
		$hasAccess = false;
		foreach ($postAccess as $postAccessSuperGroup) {
			$hasAccess |= $this->superGroupHasAccess($userAccess, $postAccessSuperGroup);
		}
		return $hasAccess;
	}

	private function superGroupHasAccess($userAccess, $postAccess) {
		$postAccess = $this->separateInAccessIntervals($postAccess);
		$success = true;
		foreach ($postAccess as $groupKey => $postAccessGroup) {
			if (!array_key_exists($groupKey, $userAccess)) {
				return false;
			}
			$success = $success && $this->hasAccessOneInterval($userAccess[$groupKey], $postAccessGroup);
		}
		return $success == true;
	}

	private function hasAccessOneInterval($userAccess, $postAccess) {
		if (empty($postAccess)) {
			return true;
		}

		$union = array_intersect($postAccess, $userAccess);
		return !empty($union);
	}

	private function separateInAccessIntervals($access) {
		$array = array();
		foreach ($access as $id) {
			$i = floor($id / 1000);
			$array[$i][] = $id;
		}
		return $array;
	}

	private function getAccessRelations($type, $id) {
		$accessRelation = new AccessRelation($type, $id);
		return $accessRelation->get();
	}

	public function hasAccessToGroup($groupId) {
		return in_array(Access::GROUP_START + $groupId, $this->access);
	}

	public function hasAccess($id) {
		return in_array($id, $this->access);
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