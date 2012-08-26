<?php

class DefaultController extends Controller {

	public function actionView($id) {
		$event = BpcEvent::getById($id);
		if (!$event) {
			throw new CHttpException(404, "Denne bedriftspresentasjonen finnes ikke");
		}
		$this->render('view', array(
			'event' => $event,
			'news' => $this->getNews($id),
			'isAttending' => $event->isAttending(user()->id),
		));
	}

	public function actionEdit($id) {
		if (!user()->checkAccess('admin')) {
			throw new CHttpException(400, 'Du har ikke tilgang til å endre dette');
		}
		$eventCompany = EventCompany::model()->find('bpcID = ?', array($id));
		if ($eventCompany === null) {
			throw new CHttpException(404, "Kunne ikke finne bedpress");
		}

		if (Yii::app()->request->isPostRequest) {
			$input = $_POST['EventCompany'];
			$eventCompany->setAttributes($input, false);
			$eventCompany->save();
			$this->redirect($this->createUrl('view', array('id' => $id)));
			Yii::app()->end();
		}

		$this->render('eventCompanyForm', array(
			'model' => $eventCompany,
			'news' => $this->getNews($id),
		));
	}

	private static function getNews($bpcID) {
		$bedpress = EventCompany::model()->with('event')->find('bpcID = ?', array($bpcID));
		$event = $bedpress->event;
		$news = News::model()->find("parentId = ? AND parentType = 'event'", array(
			$event->id));
		return $news;
	}

	public function actionToggleAttending($bpcId) {
		if (user()->isGuest) {
			throw new CHttpException(403, "Du er ikke logget inn");
		}
		$userId = user()->id;
		$event = new BpcEvent($bpcId);
		$isAttending = $event->isAttending($userId);
		if ($isAttending) {
			if ($event->canUnattend()) {
				$event->removeAttending($userId);
			}
		} else {
			if ($event->canAttend($userId)){
				$event->addAttending($userId);
			}
		}
		$url = $this->createUrl('view', array('id' => $bpcId));
		$this->redirect($url);
	}

}