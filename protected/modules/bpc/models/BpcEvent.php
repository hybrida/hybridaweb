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
		$request = BpcCore::doRequest($postdata);
		if (!isset($request['error'])) {
			$eventData = $request['event'][0];
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
		if (!$user) return false;
		$classYear = $user->classYear;
		$signupIsOn = $this->registration_started == 1 && $this->deadline_passed == 0;
		$okYear = $classYear >= $this->min_year && $classYear <= $this->max_year;
		$hasAccess = app()->gatekeeper->hasPostAccess('bpc', $this->id);
		return $signupIsOn && $okYear && $hasAccess;
	}
	
	private function pb($b) {
		return $b ? "true" : "false";
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

}
