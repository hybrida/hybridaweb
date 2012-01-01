<?php

class DefaultController extends Controller {
	
	public function actionIndex() {
		$this->render('index');
	}

	public function actionLogin($id) {
		$identity = new DefaultIdentity($id);
		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect(user()->returnUrl);
		}
	}
	
	public function actionDumpNews() {
		$lipsum = new LoremIpsumGenerator();
		$i = 0;
		for ($i = 0; $i < 150; $i++) {
			$news = new News;
			$news->title = "Lipsum $i";
			$news->content = $lipsum->getContent(rand(100, 700));
			$news->save();
		}
		echo "Suksess: Laget $i nye dummy-elementer";
	}
	
	public function actionCleanDB() {
		Yii::import('application.tests.testlib.*');
		TestLib::deleteDummyData();
		echo "Database is cleaned";
	}

}