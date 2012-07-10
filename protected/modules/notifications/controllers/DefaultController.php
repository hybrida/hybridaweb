<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$notifications = Notifications::getUnread(user()->id);
		$this->render('index', array(
			'notifications' => $notifications,
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
