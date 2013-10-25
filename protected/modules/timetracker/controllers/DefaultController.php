<?php

Yii::import("timetracker.models.*");

class DefaultController extends Controller
{
	public function userHasAccess($userId) {
		return TrackerUser::model()->findByPk($userId) != NULL;
	}

	public function actionIndex()
	{
		if (Yii::app()->user->isGuest || !$this->userHasAccess(user()->id)) {
			throw new CHttpException(403, "Du har ikke lov til å komme inn hit");
		}
		$this->render('index');
	}
}