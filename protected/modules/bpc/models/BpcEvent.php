<?php

class BpcEvent extends CModel {

	public $id;
	public $title;
	public $description;
	public $description_formatted;
	public $time;
	public $place;
	public $deadline;
	public $deadline_passed;
	public $registration_start;
	public $registration_started;
	public $seats;
	public $seats_available;
	public $this_attending;
	public $open_for;
	public $min_year;
	public $max_year;
	public $count_waiting;
	public $waitlist_enabled;
	public $web_page;
	public $is_advertised;
	public $logo;
	private $exists = false;
	private $attenders;
	private $waiters;

	public static function getById($id) {
		$event = new BpcEvent($id);
		if ($event->exists()) {
			return $event;
		}
		return null;
	}

	public static function getByRequest($request) {

	}

	public function __construct($id) {
		$this->id = $id;
		$this->doRequest();
	}

	private function doRequest() {
		$postdata = array(
			'request' => 'get_events',
			'event' => $this->id,
		);
		$request = new BpcRequest($postdata);
		$request->send();
		$response = $request->getResponse();
		if (!isset($response['error'])) {
			$eventData = $response['event'][0];
			$this->exists = true;
			$this->setAttributes($eventData, false);
			$this->attenders = new BpcAttending($this->id);
			$this->waiters = new BpcWaitingList($this->id);
		}
	}

	public function exists() {
		return $this->exists;
	}

	public function attributeNames() {
		return array(
			'id', 'title', 'description', 'description_formatted', 'time',
			'place', 'deadline', 'deadline_passed', 'registration_start',
			'registration_started', 'seats', 'seats_available', 'this_attending',
			'open_for', 'min_year', 'max_year', 'count_waiting',
			'waitlist_enabled', 'web_page', 'is_advertised', 'logo',
		);
	}

	public function canAttend($userId) {
		$user = User::model()->findByPk($userId);
		if (!$user) {
			return false;
		}
		$hasAccessToSignup = $this->hasAccessToSignup($userId);
		$classYear = $user->classYear;
		$signupIsOn = $this->isOpen();
		$okYear = $classYear >= $this->min_year && $classYear <= $this->max_year;
		$availableSeats = $this->seats_available > 0;
		$isWaitingList = (int)$this->waitlist_enabled === 1;
		$availableSeatsOrWaitingList = $availableSeats || $isWaitingList;
		return $signupIsOn && $okYear && $availableSeatsOrWaitingList && $hasAccessToSignup;
	}

	private function hasAccessToSignup($userId) {
		$event = $this->getEvent();
		if (!$event) {
			return true;
		}
		$signup = $event->signup;
		return app()->gatekeeper->hasPostAccess('signup', $signup->eventId);
	}

	private function getEvent() {
		return Event::model()->
				with('eventCompany', 'signup')->
				find(
					 "eventCompany.bpcID = ?",
					 array($this->id));
	}

	public function isOpen() {
		return $this->registration_started == 1 && $this->deadline_passed == 0;
	}

	public function canUnattend() {
		return $this->isOpen();
	}

	public function getAttending() {
		return $this->attenders->activeRecords;
	}

	public function getAttendingByYear() {
		return $this->attenders->getActiveRecordsInYearArray();
	}

	public function getWaiting() {
		return $this->waiters->activeRecords;
	}

	public function getWaitingByYear() {
		return $this->waiters->getActiveRecordsInYearArray();
	}

	public function isNextAttenderSentToWaitlist() {
		return $this->seats_available == 0 && $this->waitlist_enabled === 1;
	}

	public function addAttending($userId) {
		BpcCore::addAttending($this->id, $userId);
	}

	public function removeAttending($userId) {
		BpcCore::removeAttending($this->id, $userId);
	}

	public function isAttending($userId) {
		$user = User::model()->findByPk($userId);
		if (!$user) {
			return;
		}
		$isWaiting = $this->waiters->contains($user->username);
		$isAttending = $this->attenders->contains($user->username);
		return $isWaiting || $isAttending;
	}

	public function getViewUrl() {
		return Yii::app()->createUrl('/bpc/default/view', array(
					'id' => $this->id,
					'title' => $this->title,
				));
	}

	public function getGoogleCalendarUrl() {
		$startTime= strtotime($this->time);
		$endTime = $startTime + 3600*4;
		$from = $this->getUTC($startTime);
		$to = $this->getUTC($endTime);
		$details = $this->description_formatted;
		do {
			$old = $details;
			$details = str_replace(PHP_EOL.PHP_EOL, PHP_EOL, $old);
		} while ($old !== $details);
		$details = strip_tags($details);
		$details = $this->shortenDetails($details);
		$details = trim($details);
		$details = str_replace(PHP_EOL, "%0A", $details);
		$details = $this->spaceToUrl($details);

		return "http://www.google.com/calendar/event?action=TEMPLATE" .
				"&text={$this->spaceToUrl($this->title)}" .
				"&dates={$from}/{$to}" .
				"&details={$details}" .
				"&location={$this->spaceToUrl($this->place)}" .
				"&trp=true" .
				"&sprop=http%3A%2F%2Fhybrida.no" .
				"&sprop=name:Hybrida";
	}

	private function shortenDetails($details) {
		if (strlen($details) > 700) {
			return substr($details, 0, 700);
		}
		return $details;
	}

	private function spaceToUrl($text) {
		return str_replace(" ", "%20", $text);
	}

	private function getUTC($time) {
		return gmdate("Ymd\THis\Z",$time);
	}

}
