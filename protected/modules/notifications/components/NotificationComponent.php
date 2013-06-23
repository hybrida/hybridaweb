<?php

Yii::import('notifications.models.Notifications');
Yii::import('notifications.models.NotificationListener');

class NotificationComponent extends CComponent {

	public function init() {

	}

	public function addListener($type, $id, $userId) {
		Notifications::addListener($type, $id, $userId);
	}

	public function removeListener($type, $id, $userId) {
		Notifications::removeListener($type, $id, $userId);
	}

}