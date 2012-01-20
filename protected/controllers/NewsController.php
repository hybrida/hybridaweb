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
	
	private function getIdFromString($idString) {
		$array = explode('+',$idString);
		if (isset($array[0])) {
			return $array[0];
		}
		return '';
	}

	public function actionView($id) {
		$id = $this->getIdFromString($id);
		$signup = null;

		$news = News::model()->with('author')->findByPk($id);
		if (!$news) {
			throw new CHttpException("Nyheten finnes ikke");
		}

		$gk = new GateKeeper;
		if (!$gk->hasAccess('news', $id)) {
			throw new CHttpException('Ingen tilgang');
		}

		$event = $news->event;
		if ($event && $event->signup && $gk->hasAccess('signup', $event->signup->eventId)) {
			$signup = $event->signup;
		}

		$this->render('view', array(
			'news' => $news,
			'event' => $event,
			'signup' => $signup,
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