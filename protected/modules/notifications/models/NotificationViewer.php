<?php

class NotificationViewer extends CComponent {

	private $list = array();
	private $groups= array();

	public function __construct($list) {
		$this->list = $list;
		$this->sortInGroups();
	}

	private function sortInGroups() {
		foreach ($this->list as $notification) {
			$group = $this->getGroup($notification);
			if (!$group) {
				$group = new NotificationGroup;
				$this->groups[] = $group;
			}
			$group->add($notification);
		}
	}

	private function getGroup($not) {
		foreach ($this->groups as $group) {
			if ($group->isGroupFor($not)) {
				return $group;
			}
		}
		return false;
	}

	public function getGroups() {
		return $this->groups;
	}

}

class NotificationGroup extends CComponent {

	private $list=array();
	private $statusCode;
	private $users=array();
	private $parentID;
	private $parentType;
	private $timestamp;
	private $message;

	public function add($notification) {
		if ($this->statusCode === null) {
			$this->statusCode = $notification->statusCode;
			$this->parentID = $notification->parentID;
			$this->parentType = $notification->parentType;
			$this->timestamp = $notification->timestamp;
			$this->message = $notification->message;
		}
		$this->list[] = $notification;
		$this->users[] = $notification->changedByUser;
	}

	public function isGroupFor($notification) {
		return $this->statusCode == $notification->statusCode &&
				$this->parentID == $notification->parentID &&
				$this->parentType == $notification->parentType;
	}

	public function getTimestamp() {
		return $this->timestamp;
	}

	public function getChangedByUserHtml(){
		$profileLinks = array();

		if (count($this->users) <= 3) {
			return $this->getChangedByUserHtmlFewUsers();
		} else {
			return $this->getChangedByUserHtmlManyUsers();
		}
	}

	private function getChangedByUserHtmlFewUsers() {
		$userIds = array();
		foreach ($this->users as $user) {
			if (in_array($user->id, $userIds)) {
				continue;
			}
			$profileLinks[] = CHtml::link($user->fullName, $user->viewUrl);
			$userIds[] = $user->id;
		}
		return implode(" og ", $profileLinks);
	}

	private function getChangedByUserHtmlManyUsers() {
		$firstUser = $this->users[0];
		$numberOfUsersLeft = count($this->users) - 1;
		return CHtml::link($firstUser->fullName, $firstUser->viewUrl) . " og $numberOfUsersLeft andre";
	}

	public function getMessage() {
		return $this->message;
	}

	public function getIds() {
		$ids = array();
		foreach ($this->list as $notification) {
			$ids[] = $notification->id;
		}
		return implode(',',$ids);
	}

	public function getViewUrl() {
		$url = $this->list[0]->viewUrl;

		// Nettleserere takler ikke urler med over 2000 characters. Derfor
		// kutter vi ned litt. Tror ikke dette egentlig er noe reelt problem.

		$listOfFewerNotifications = array_slice($this->list, 1, 300);
		foreach ($listOfFewerNotifications as $notification) {
			if ($notification->commentID !== null) {
				$url .= "," . $notification->commentID;
			}
		}
		return $url;
	}

	public function getViewUrlNoFlash() {
		$url = $this->list[0]->viewUrl;
		$split = explode('#', $url);
		return $split[0];
	}

	public function getTitle() {
		return $this->list[0]->title;
	}

}