<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}

	public function actionSearch() {

		$split = '~%~';

		$result['users'] = $this->searchUsers();
		$result['newsList'] = $this->searchNews();
		$result['url'] = Yii::app()->baseUrl . "/profile/";
		$result['split'] = $split;

		$this->renderPartial('search', $result);
	}

}