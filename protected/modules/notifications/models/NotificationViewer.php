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

		if (count($this->users) >= 3) {
			return $this->getChangedByUserHtmlManyUsers();
		} else {
			return $this->getChangedByUserHtmlFewUsers();
		}
	}

	private function getChangedByUserHtmlFewUsers() {
		foreach ($this->users as $user) {
			$profileLinks[] = CHtml::link($user->fullName, $user->viewUrl);
		}
		return implode(", ", $profileLinks);
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
		foreach ($this->list as $notification) {
			if ($notification->commentID !== null) {
				$url .= "," . $notification->commentID;

			}
		}
		return $url;
	}

	public function getTitle() {
		return $this->list[0]->title;
	}

}