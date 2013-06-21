<?php


Yii::import('notifications.models.*');
class FollowButton extends CWidget {

	public $id;
	public $type;
	public $isFollowing = false;

	public function init() {
		if (user()->isGuest) {
			return;
		}
		$this->isFollowing = Notifications::isListening(
				$this->type,
				$this->id,
				user()->id);
	}

	public function run() {
		if (user()->isGuest) {
			return;
		}
		$this->render('followButton');
	}

}