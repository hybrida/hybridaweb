<?php

class NewsController extends Controller {

	private $feedLimit = 10;
	private $offset = 0;

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
			$url = $this->createUrl('/event/view', array(
				'id' => $news->parentId,
			));
			$this->redirect($url);
			return;
		}
		
		
		$data = $news->attributes;
		$this->render('view', array(
			'model' => $news,
		));

	}

	public function actionFeed() {
		$feedElements = $this->getFeedElements();
		$this->render("feed", array(
			'models' => $feedElements,
			'index' => $this->offset,
			'limit' => $this->feedLimit,
		));
	}

	public function actionFeedAjax($offset = 0) {
		$feedElements = $this->getFeedElements($offset);
		$this->renderPartial('_feed', array(
			'models' => $feedElements,
			'index' => $this->offset,
			'limit' => $this->feedLimit,
		));
	}
	
	private function getFeedElements($offset=0) {
		$feed = new NewsFeed($this->feedLimit, $offset);
		$elements = $feed->getElements();
		$this->offset = $feed->getOffset();

		return $elements;
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