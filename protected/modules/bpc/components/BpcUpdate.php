<?php

class BpcUpdate {

	private $news;
	private $event;
	private $signup;

	const MAX_INGRESS_LENGTH = 700;

	public function update($bpcID) {
		$postData = array(
			'request' => 'get_events',
			'event' => $bpcID,
		);
		$response = $this->getBpcResponse($postData);
		if (isset($response['event'][0])) {
			$event = $response['event'][0];
			$this->updateBedpres($event);
		}
	}

	protected function getBpcResponse($postdata) {
		$request = new BpcRequest($postdata);
		$request->send();
		$response = $request->getResponse();
		return $response;
	}

	public function updateAll() {
		$postData = array(
			'request' => 'get_events',
		);
		$response = $this->getBpcResponse($postData);
		$this->updateAllBedpresses($response);
	}

	private function updateAllBedpresses($data) {
		if (!isset($data['event'])) {
			return;
		}
		foreach ($data['event'] as $event) {
			$this->updateBedpres($event);
		}
	}

	private function updateBedpres($bedpressData) {
		$this->init($bedpressData['id']);
		$this->saveEvent($bedpressData);
		$this->saveSignup($bedpressData);
		$this->saveNews($bedpressData);
	}

	public function init($bpcID) {
		$this->initEvent($bpcID);
		$this->initNews();
	}

	private function initEvent($bpcID) {
		$bedpress = EventCompany::model()->with('event')->find('bpcID = ?', array($bpcID));
		$event = false;
		if ($bedpress) {
			$event = $bedpress->event;
		}
		if ($event) {
			$this->event = $event;
			$this->signup = $event->signup;
		} else {
			$this->event = new Event;
		}
		if (!$this->signup) {
			$this->signup = new Signup;
		}
	}

	private function initNews() {
		if (!$this->event->isNewRecord) {
			$this->initNewsByEvent();
		} else {
			$this->news = new News;
		}
	}

	private function initNewsByEvent() {
		$news = News::model()->find('parentId = ? AND parentType = "event"', array(
			$this->event->id
				));
		if ($news) {
			$this->news = $news;
		} else {
			$this->news = new News;
		}
	}

	private function saveEvent($bpc) {
		$event = $this->event;
		$event->start = $bpc['time'];
		$event->end = $bpc['time']; // FIXME
		$event->location = $bpc['place'];
		$event->save();
		$event->saveBedpress($bpc['id']);
	}

	private function saveSignup($bpc) {
		$signup = $this->signup;
		$signup->close = $bpc['deadline'];
		$signup->open = $bpc['registration_start'];
		$signup->spots = $bpc['seats'];
		$signup->eventId = $this->event->id;
		$signup->status = Status::DELETED; //All signups happens through bpc
		$signup->save();
	}

	private function saveNews($bpc) {
		$news = $this->news;
		$news->title = 'Bedpress: ' . $bpc['title'];
		$news->content = $bpc['description_formatted'];
		$news->ingress = $this->shortenIngress($bpc['description']);
		$news->setParent('event', $this->event->id);
		$news->save();
		$news->authorId = null;
		$news->save();
	}

	private function shortenIngress($description) {
		$descriptionLength = strlen($description);
		if ($descriptionLength < self::MAX_INGRESS_LENGTH)
			return $description;
		return substr($description, 0, self::MAX_INGRESS_LENGTH) . "...";
	}

}