<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$notifications = Notifications::getNotifications(user()->id);
		$this->render('index', array(
			'notifications' => $notifications,
		));
	}

}
