<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$unread = Notifications::getUnread(user()->id);
		$read = Notifications::getRead(user()->id, 10);
		$this->render('index', array(
			'unread' => $unread,
			'read' => $read,
		));
	}

	public function actionDelete($id) {
		$notification = Notification::model()->findByPk($id);
		if ($notification->userID !== user()->id)
			Yii::app()->end();
		$notification->isRead = true;
		$notification->save();
	}

}
