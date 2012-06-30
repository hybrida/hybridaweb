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
		));
	}
	
	public function actionEdit($id) {
		$eventCompany = EventCompany::model()->find('bpcID = ?', array($id));
		if ($eventCompany === null) {
			throw new CHttpException(404, "Kunne ikke finne bedpress");
		}
		
		if (Yii::app()->request->isPostRequest) {
			print_r($_POST);
			$input = $_POST['EventCompany'];
			$event = EventCompany::model()->find('bpcID = ?', array(
				$input['bpcID'],
			));
			if (!$event) {
				throw new CException("Bedpressen du prøver å endre finnes ikke");
			}
			$event->setAttributes($input, false);
			$event->save();
			$this->redirect($this->createUrl('view', array('id' => $id)));
			Yii::app()->end();
		}
		
		$this->render('eventCompanyForm', array(
			'model' => $eventCompany,
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
		if ($event->canAttend($userId)) {
			if (!$event->isAttending($userId)) {
				$event->addAttending($userId);
			} else {
				$event->removeAttending($userId);
			}
		}
		$url = $this->createUrl('view', array('id' => $bpcId));
		$this->redirect($url);
	}

}