<?php

class DefaultController extends Controller {

	public function actionView($id) {
		$event = BpcEvent::getById($id);
		if (!$event) {
			throw new CHttpException(404, "Denne bedriftspresentasjonen finnes ikke");
		}
		$this->render('view', array(
			'event' => $event,
                        'newsid' => $this->getNewsID($id),
		));
	}
        
        private static function getNewsID($bpcID) {
			$bedpress = EventCompany::model()->with('event')->find('bpcID = ?', array($bpcID));
            $event = $bedpress->event;
            $news = News::model()->find("parentId = ? AND parentType = 'event'",array(
                $event->id
            ));
            return $news->id;
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