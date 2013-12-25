<?php

class FrontpageBannerController extends Controller {

	public function actionIndex() {
		$this->render('index', array(
			'model' => new FrontpageBanner,
		));
	}

	public function actionCreate() {

	}

}
