<?php

Yii::import('notifications.models.Notifications');
Yii::import('notifications.models.NotificationListener');
Yii::import('notifications.models.Notification');

class NotificationComponent extends CComponent {

	public function init() {

	}

	public function addListener($type, $id, $userId) {
		Notifications::addListener($type, $id, $userId);
	}

	public function removeListener($type, $id, $userId) {
		Notifications::removeListener($type, $id, $userId);
	}

	public function notifyAndAddListener($type, $id, $statusCode, $userId=null, $commentId=null) {
		Notifications::notifyAndAddListener(
			$type, $id, $statusCode, $userId, $commentId);
	}

	public function getCount() {
		return Notifications::getCount(user()->id);
	}

}