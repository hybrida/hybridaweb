<?php

class BpcUpdate {

	private $news;
	private $event;
	private $signup;

	public function updateAll() {
		$postData = array(
			'request' => 'get_events',
		);
		$data = BpcCore::doRequest($postData);
		$this->updateAllBedpresses($data);
	}

	public function update($bpcID) {
		$postData = array(
			'request' => 'get_events',
			'event' => $bpcID,
		);
		$data = BpcCore::doRequest($postData);
		if (isset($data['event'][0])) {
			$event = $data['event'][0];
			$this->updateBedpres($event);
		}
	}

	private function updateAllBedpresses($data) {
		if (!isset($data['event'])) {
			return;
		}
		foreach ($data['event'] as $event) {
			$this->updateBedpres($event);
		}
	}

	private function updateBedpres($bedpresData) {
		$this->init($bedpresData['id']);
		$this->saveEvent($bedpresData);
		$this->saveNews($bedpresData);
		$this->saveSignup($bedpresData);
		$this->updateMemberships();
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

	private function updateMemberships() {
		$usernames = $this->getAttendingUsernames($this->event->bpcID);
		$this->clearMembershipsOnEvent();
		foreach ($usernames as $username) {
			$this->updateMembership($username);
		}
	}

	private function clearMembershipsOnEvent() {
		$this->signup->removeAllAttenders();
	}

	public function getAttendingUsernames($bpcID) {
		$array = array(
			'request' => 'get_attending',
			'event' => $bpcID,
		);
		$data = BpcCore::doRequest($array);
		$names = array();
		if (!isset($data['users'])) {
			return array();
		}
		foreach ($data['users'] as $user) {
			$names[] = $user['username'];
		}
		return $names;
	}

	public function updateMembership($username) {
		$user = User::model()->find('username = ?', array($username));
		if (!$user)
			return;
		$this->signup->addAttender($user->id);
	}

}