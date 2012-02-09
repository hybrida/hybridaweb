<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$this->renderPartial('index');
	}

	public function actionTest() {
		$this->render('test');
	}
	
	public function actionUpdate() {
		echo "<pre>";
		$get = new BpcUpdate;
		$get->update();
	}


}