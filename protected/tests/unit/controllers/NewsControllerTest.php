<?php

Yii::import('application.controllers.NewsController');

class NewsControllerTest extends CTestCase {

	public function test_getNewsModel_idExists() {
		$news = new News;
		$news->title = "dummy title";
		$news->content = "dummy content";

		$news->save();

		$controller = new NewsController(2);
		$this->assertNotEquals(null, $news->id);
		$this->assertEquals($news->id, $controller->getNewsModel($news->id)->id);
	}

	/**
	 * @expectedException CHttpException
	 */
	public function test_getNewsModel_idDoesNotExist() {
		$news = new News;

		$controller = new NewsController(2);
		$nonExistingId = 214234;
		$controller->getNewsModel($nonExistingId);
	}

	/**
	 * @expectedException CHttpException
	 */
	public function test_getNewsModel_idIsNull() {
		$controller = new NewsController(2);
		$controller->getNewsModel(null);
	}
}
