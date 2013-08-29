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
				'actions' => array("index", "delete", "follow"),
				'users' => array('@'),
			),
			array('deny'),
		);
	}

	public function actionIndex() {
		$unread = Notifications::getUnread(user()->id);
		$unreadViewer = new NotificationViewer($unread);

		$read = Notifications::getRead(user()->id, 100);
		$readViewer = new NotificationViewer($read);

		$this->render('index', array(
			'unread' => $unreadViewer->getGroups(),
			'read' => $readViewer->getGroups(),
		));
	}

	public function actionDelete($ids) {
		$idArray = explode(',', $ids);
		foreach($idArray as $id) {
			$notification = Notification::model()->findByPk($id);
			if ($notification->userID !== user()->id) {
				Yii::app()->end();
			}
			$notification->isRead = 1;
			$notification->save();
		}
	}

	public function actionFollow($type, $id, $toggle) {
		if ($toggle == "unfollow") {
			Notifications::removeListener($type, $id, user()->id);
			echo "Følg";
		} else {
			Notifications::addListener($type, $id, user()->id);
			echo "Ikke følg";
		}
	}

}
