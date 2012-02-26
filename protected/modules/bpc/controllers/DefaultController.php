<?php

class DefaultController extends Controller {

	public function actionView($id) {
		$event = BpcEvent::getById($id);
		if (!$event) {
			throw new CHttpException(404, "Denne bedriftspresentasjonen finnes ikke");
		}
		$this->render('view', array(
			'event' => $event,
		));
	}

	public function actionToggleAttending($userId, $bpcId) {
		$event = new BpcEvent($bpcId);
		if ($event->canAttend($userId)) {
			if (!$event->isAttending($userId)) {
				$event->addAttending($userId);
			} else {
				$event->removeAttending($userId);
			}
			$this->renderPartial('_attenders', array(
				'event' => new BpcEvent($bpcId),
			));
		}
	}
}