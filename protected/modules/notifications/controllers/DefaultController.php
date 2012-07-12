<?php

class DefaultController extends Controller {

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("index", "delete"),
				'users' => array('@'),
			),
			array('deny'),
		);
	}

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
