<?php

class DefaultController extends Controller {

	public function actionView($id) {
		$event = BpcEvent::getById($id);
		if (!$event) {
			throw new CHttpException(404, "Bedriftspresentasjonen finnes ikke");
		}
		$isAttending = $event->isAttending(user()->id);
		$canAttend = !$isAttending && $event->canAttend(user()->id) && !$event->isNextAttenderSentToWaitlist();
		$canAttendWaitlist = !$isAttending && $event->canAttend(user()->id) && $event->isNextAttenderSentToWaitlist();
		$canUnAttend = $isAttending && $event->canUnattend();

		$this->render('view', array(
			'event' => $event,
			'news' => $this->getNews($id),
			'canAttend' => $canAttend,
			'canUnAttend' => $canUnAttend,
			'canAttendWaitlist' => $canAttendWaitlist,
			'isAttending' => $isAttending,
			'canSupportFieldtrip' => FieldtripSupport::canSupport(User::model()->findByPk(user()->id)),
		));
	}

	public function actionEdit($id) {
		if (!user()->checkAccess('updateBedpres')) {
			throw new CHttpException(403, 'Du har ikke tilgang til å endre dette');
		}
		$eventCompany = EventCompany::model()->find('bpcID = ?', array($id));
		if ($eventCompany === null) {
			throw new CHttpException(404, "Bedriftspresentasjonen finnes ikke");
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
		if (!Yii::app()->request->isPostRequest) {
			throw new CHttpException(400, "Action only accepts post-requests");
		} elseif (user()->isGuest) {
			throw new CHttpException(403, "Du er ikke logget inn");
		}

		$user = User::model()->findByPk(user()->id);
		$supportFieldtrip = $_POST['supportFieldtrip'];
		$event = new BpcEvent($bpcId);
		$this->setFieldtripSupport($event, $user, $supportFieldtrip);
		$this->toggleAttending($event, $user);

		$url = $this->createUrl('view', array('id' => $bpcId));
		$this->redirect($url);
	}

	private function setFieldtripSupport($event, $user, $supportFieldtrip) {
		if (!FieldtripSupport::canSupport($user)) {
			return;
		}
		if ($supportFieldtrip) {
			FieldtripSupport::support($event, $user);
		} else {
			FieldtripSupport::removeSupport($event, $user);
		}
	}

	private function toggleAttending($event, $user) {
		$isAttending = $event->isAttending($user->id);
		if ($isAttending) {
			if ($event->canUnattend()) {
				$event->removeAttending($user->id);
			}
		} else {
			if ($event->canAttend($user->id)){
				$event->addAttending($user->id);
			}
		}
	}

}