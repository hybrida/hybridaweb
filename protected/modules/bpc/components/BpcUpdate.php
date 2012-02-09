<?php

class BpcUpdate {

	private $news;
	private $event;
	private $signup;

	public function update() {
		$postData = array(
			'request' => 'get_events',
		);
		$data = BpcCore::doRequest($postData);
		$this->addAllBedpresses($data);
	}

	private function addAllBedpresses($data) {
		foreach ($data['event'] as $event) {
			$this->addBedpres($event);
		}
	}

	private function addBedpres($bedpresData) {
		$this->init($bedpresData['id']);
		$this->saveEvent($bedpresData);
		$this->saveNews($bedpresData);
		$this->saveSignup($bedpresData);
	}

	public function init($bpcID) {
		$this->initEvent($bpcID);
		$this->initNews();
	}

	private function initEvent($bpcID) {
		$event = Event::model()->find('bpcID = ?', array($bpcID));
		if ($event) {
			$this->event = $event;
			$this->signup = $event->signup;
		} else {
			$this->event = new Event;
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
		$event->bpcID = $bpc['id'];
		$event->start = $bpc['time'];
		$event->end = $bpc['time']; // FIXME
		$event->save();
	}

	private function saveNews($bpc) {
		$news = $this->news;
		$news->title = $bpc['title'];
		$news->content = $bpc['description'];
		$news->ingress = "Bedriftspresentasjon";
		$news->setParent('event', $this->event->id);
		$news->save();
	}

	private function saveSignup($bpc) {
		$signup = $this->signup;
		$signup->close = $bpc['deadline'];
		$signup->open = $bpc['registration_start'];
		$signup->spots = $bpc['seats_available'];
		$signup->access = $this->getAccessYears($bpc['min_year'], $bpc['max_year']);
		$signup->eventId = $this->event->id;
		$signup->save();
	}

	// FIXME: fungerer bare på vårsemesteret
	private function getAccessYears($from, $to) {
		$years = array();
		for ($i = $from; $i <= $to; $i++) {
			$year = date('Y') + 5;
			$access = $year - $i;
			$years[] = $access;
		}
		return $years;
	}

}