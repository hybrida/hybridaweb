<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsController
 *
 * @author sigurd
 */
class NewsController extends Controller {

	private $feedLimit = 10;

	public function actionIndex() {
		$this->actionFeed();
	}

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("view"),
				'users' => array('*'),
			),
			array('deny',
				'actions' => array("edit", "create"),
				'users' => array('?'),
			),
			array('allow',
				'actions' => array("edit", "create"),
				'users' => array('@'),
			),
		);
	}

	public function actionView($id) {
		$news = News::model()->findByPk($id);
		if (!$news) {
			throw new CHttpException("Nyheten finnes ikke");
		}
		if ($news->getParentType() === 'event') {
			$this->forward('/event/view/',array($id => $news->parentId));
			return;
		}
		
		
		$data = $news->attributes;
		$this->render('view', array(
			'model' => $news,
		));

	}

	public function actionFeed() {
		$feedElements = $this->getFeedElements();
		$this->render("feed2", array(
			'models' => $feedElements,
			'index' => 0,
			'limit' => $this->feedLimit,
		));
	}

	public function actionFeedAjax($offset = 0) {
		$feedElements = $this->getFeedElements($offset);
		$offset += count($feedElements);
		$this->renderPartial('_feed', array(
			'models' => $feedElements,
			'index' => $offset,
			'limit' => $this->feedLimit,
		));
	}
	
	private function getFeedElements($offset=0) {
		$feed = new NewsFeed($this->feedLimit, $offset);
		return $feed->getElements();
	}

	public function actionCreate() {
		$this->renderNewsEventForm(New News);
	}

	public function actionEdit($id) {
		$model = $this->getNewsModel($id);
		$this->renderNewsEventForm($model);
	}

	public function getNewsModel($id) {
		$model = News::model()->findByPk($id);
		if ($model)
			return $model;
		else
			throw new CHttpException("Nyheten finnes ikke");
	}

	private function renderNewsEventForm($inputModel) {
		$model = new NewsEventForm($inputModel);
		$isUpdated = false;

		if (isset($_POST['NewsEventForm'])) {
			$input = $_POST['NewsEventForm'];
			$model->setAttributes($input);
			$model->save();

			$this->redirectAfterEdit($model);
			return;
		}

		$this->render("edit", array(
			'model' => $model,
			'updated' => $isUpdated,
		));
	}

	private function redirectAfterEdit($model) {
		$newsModel = $model->getNewsModel();
		if (!$newsModel->isNewRecord) {
			$this->redirect(array(
				"news/view",
				"id" => $newsModel->id
			));
		}
	}

}