<?php

Yii::import('bpc.components.*');

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
				'actions' => array("view", "edit", 'feed', 'feedAjax', 'index', 'toggleAttending'),
			),
			array('allow',
				'actions' => array("create"),
				'roles' => array('createNews'),
			),
			array('deny'),
		);
	}

	public function actionView($id) {
		$news = $this->getNewsModelAndThrowExceptionIfNullOrNotAccess($id);
		$event = $this->getEventByNews($news);
		if ($event) {
			if ($event->bpcID) {
				$this->redirectToBpc($event->bpcID, $news->title);
				return;
			}
		}
		$signup = $this->getSignupByEvent($event);
		$isAttending = false;
		if ($signup) {
			$isAttending = $signup->isAttending(user()->id);
		}

		$this->render('view', array(
			'news' => $news,
			'event' => $event,
			'signup' => $signup,
			'isAttending' => $isAttending,
			'hasEditAccess' => user()->checkAccess('updateNews', array('id' => $id)),
		));
	}

	private function redirectToBpc($id, $title) {
		$url = $this->createUrl('/bpc/default/view', array(
			'id' => $id,
			'title' => $title,
				));
		$this->redirect($url);
	}

	private function getNewsModelAndThrowExceptionIfNullOrNotAccess($id) {
		$news = News::model()->with('author')->findByPk($id);

		if (!$news)
			throw new CHttpException('Nyheten finnes ikke');
		if (!app()->gatekeeper->hasPostAccess('news', $news->id))
			throw new CHttpException('Ingen tilgang');
		return $news;
	}

	private function getEventByNews($news) {
		if ($news->parentType != 'event') {
			return null;
		}
		$event = $news->event;

		if ($event &&
				$event->status == Status::PUBLISHED &&
				app()->gatekeeper->hasPostAccess('event', $event->id)) {
			return $event;
		}
		return null;
	}

	private function getSignupByEvent($event) {
		if (!$event) {
			return null;
		}
		$signup = $event->signup;
		if ($signup &&
				$signup->status == Status::PUBLISHED &&
				app()->gatekeeper->hasPostAccess('signup', $signup->eventId)) {
			return $signup;
		}
		return null;
	}

	public function actionToggleAttending($eventId) {
		if (user()->isGuest) {
			return;
		}
		$userId = user()->id;
		$event = Event::model()->findByPk($eventId);
		$signup = $this->getSignupByEvent($event);
		if (!$signup || !$event)
			return;
		$isAttending = $signup->isAttending($userId);
		if ($signup->canAttend($userId)) {
			if ($isAttending) {
				$signup->removeAttender($userId);
			} else {
				$signup->addAttender($userId);
			}
		}
		$isAttending = ! $isAttending;

		$this->renderPartial('_view_sidebar', array(
			'event' => $event,
			'signup' => $signup,
			'isAttending' => $isAttending,
		));
	}

	public function actionFeed() {
		BpcCore::updateAll();
		$feedElements = $this->getFeedElements();
		$this->render("feed", array(
			'models' => $feedElements,
			'index' => $this->offset,
			'limit' => $this->feedLimit,
			'hasPublishAccess' => user()->checkAccess('createNews'),
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

	private function getFeedElements($offset = 0) {
		$feed = new NewsFeed($this->feedLimit, $offset);
		$elements = $feed->getElements();
		$this->offset = $feed->getOffset();

		return $elements;
	}

	public function actionCreate() {
		$this->renderNewsEventForm(New News);
	}

	public function actionEdit($id) {
		if (!user()->checkAccess('updateNews', array('id' => $id))) {
			throw new CHttpException(403, "Du har ikke tilgang til å endre denne nyheten");
		}
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

	private function redirectAfterEdit($newsEventFormModel) {
		$newsModel = $newsEventFormModel->getNewsModel();
		if (!$newsModel->isNewRecord) {
			$this->redirect($newsModel->viewUrl);
		}
	}

}
