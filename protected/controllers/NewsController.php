<?php

class NewsController extends Controller {

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("view", "edit", 'toggleAttending', 'alumniSignup', 'griffgrabber'),
			),
			array('allow',
				'actions' => array("create", "email", "manualSignup", 'deleteManualSignup', 'editManualSignup', 'editSignup'),
				'roles' => array('createNews'),
			),
			array('deny'),
		);
	}

	public function actionView($id) {
		$news = $this->getNewsModelAndThrowExceptionIfNullOrNotAccess($id);
		$event = $this->getEventByNews($news);
		$eventAccess = false;
		$signupAccess = false;
		if ($event) {
			$eventAccess = app()->gatekeeper->hasPostAccess('event', $event->id);
			$bedpress = $event->getBedpress();
			if ($bedpress) {
				$this->redirectToBpc($bedpress->bpcID, $news->title);
				return;
			}
		}
		$signup = $this->getSignupByEvent($event);
		$isAttending = false;
		if ($signup) {
			$signupAccess = app()->gatekeeper->hasPostAccess('signup', $signup->eventId);
			$isAttending = $signup->isAttending(user()->id);
		}

		$this->render('view', array(
			'news' => $news,
			'event' => $event,
			'hasAccessToEvent' => $eventAccess,
			'signup' => $signup,
			'hasAccessToSignup' => $signupAccess,
			'isAttending' => $isAttending,
			'hasEditAccess' => user()->checkAccess('updateNews', array('id' => $id)),
		));
	}

	private function getNewsModelAndThrowExceptionIfNullOrNotAccess($id) {
		$news = News::model()->with('author')->findByPk($id);

		if (!$news || $news->status == Status::DELETED)
			throw new CHttpException(404, 'Nyheten finnes ikke');
		if (!app()->gatekeeper->hasPostAccess('news', $news->id))
			throw new CHttpException(403, 'Du har ikke tilgang');
		return $news;
	}

	private function getEventByNews($news) {
		if ($news->parentType != 'event') {
			return null;
		}
		$event = $news->event;

		if ($event &&
				$event->status == Status::PUBLISHED) {
			return $event;
		}
		return null;
	}

	private function redirectToBpc($id, $title) {
		$url = $this->createUrl('/bpc/default/view', array(
			'id' => $id,
			'title' => Html::removeSpecialChars($title),
				));
		$this->redirect($url);
	}

	private function getSignupByEvent($event) {
		if (!$event) {
			return null;
		}
		return $this->getPublishedSignup($event->id);
	}

	private function getPublishedSignup($eventId) {
		$signup = Signup::model()->findByPk($eventId);
		if ($signup &&
				$signup->status == Status::PUBLISHED) {
			return $signup;
		}
		return null;
	}

	public function actionToggleAttending($eventId) {
		if (user()->isGuest) {
			return;
		}
		$userId = user()->id;
		$signup = $this->getPublishedSignup($eventId);
		if (!$signup) {
			return;
		}
		$this->toggleAttending($signup, $userId);
		$this->redirectToNewsByEventId($eventId);
	}

	private function toggleAttending($signup, $userId) {
		$isAttending = $signup->isAttending($userId);
		if ($isAttending) {
			if ($signup->canUnattend()) {
				$signup->removeAttender($userId);
			}
		} else {
			if ($signup->canAttend($userId)) {
				$signup->addAttender($userId);
			}
		}
	}

	private function redirectToNewsByEventId($eventId) {
		$news = News::model()->find("parentId = ? AND parentType = 'event'", array(
			$eventId,
				));
		$url = $news->viewUrl;
		$this->redirect($url);
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
		if ($model) {
			return $model;
		} else {
			throw new CHttpException(404, "Nyheten finnes ikke");
		}
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

	public function actionEmail($id) {
		$news = News::model()->with("event", "event.signup")->findByPk($id);
		$event = $news->event;
		if (!$event || !$event->signup) {
			throw new CHttpException(400, "Dette er ikke et arrangement");
		}
		$signup = $event->signup;
		$this->render('email', array(
			'news' => $news,
			'attenders' => $signup->attenders,
			'anonymousAttenders' => $signup->getAnonymousAttenders(),
		));
	}

	public function actionManualSignup($id) {
		$eventId = $id; // more verbose
		$signup = Signup::model()->with("event", "event.news")->findByPk($eventId);


		if (Yii::app()->request->isPostRequest) {
			$model = new SignupMembershipAnonymous();
			$model->setAttributes($_POST['SignupMembershipAnonymous']);
			$model->eventId = $id;
			$model->save();
		}

		$this->render("manual_signup", array(
			'signup' => $signup,
			'attenders' => $signup->getAnonymousAttenders(),
			'model' => new SignupMembershipAnonymous(),
			'ajaxFeedUrl' => $this->createUrl("deleteManualSignup", array("id" => "")),
		));
	}

	public function actionEditManualSignup($id) {
		$model = SignupMembershipAnonymous::model()->findByPk($id);
		if (Yii::app()->request->isPostRequest) {
			$model->setAttributes($_POST['SignupMembershipAnonymous']);
			$model->save();
			$this->redirect($this->createUrl("manualSignup", array("id" => $model->eventId)));
		} else {
			$this->render("edit_anonymous_membership", array(
				'model' => $model,
			));
		}
	}

	public function actionDeleteManualSignup($id) {
		$model = SignupMembershipAnonymous::model()->findByPK($id);
		$model->signedOff = "true";
		$model->save();
		echo CJSON::encode($model);
	}

	public function actionEditSignup($id) {
		$news = News::model()
				->with('event', 'event.signup')
				->findByPk($id);

		if ($news == null || $news->event == null || $news->event->signup == null) {
			throw new CHttpException(404, "Nyheten, hendelsen elle påmeldingen finnes ikke");
		}

		if (isset($_POST['SignupMembershipManualForm'])) {
			$form = new SignupMembershipManualForm($news->event->signup);
			$form->setAttributes($_POST['SignupMembershipManualForm'], false);
			$form->save();
		}

		$this->render('editSignup', array(
			'event' => $news->event,
			'news' => $news,
			'signup' => $news->event->signup,
			'attenders' => $news->event->signup->attenders,
			'formModel' => new SignupMembershipManualForm($news->event->signup),
		));
	}

}