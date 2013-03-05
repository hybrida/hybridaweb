<?php

class BpcEventMock extends BpcEvent {
	public function __construct() {

	}

	public static function mock($eventArray=null) {
		if ($eventArray === null) {
			$eventArray = self::getEventArray();
		}
		$event = new BpcEventMock();
		$event->setAttributes($eventArray, false);
		return $event;
	}

	public static function getEventArray() {
		return array(
			'id' => '381',
			'title' => 'Capgemini',
			'description' => 'Capgemini',
			'description_formatted' => '<p>Capgemini</p>',
			'time' => '2012-09-13 18:00:00',
			'place' => 'Unknown',
			'deadline' => '2012-09-12 11:00:00',
			'deadline_passed' => '0',
			'registration_start' => '2012-07-20 11:00:00',
			'registration_started' => '1',
			'seats' => '1',
			'seats_available' => 0,
			'this_attending' => '1',
			'open_for' => '1',
			'min_year' => '3',
			'max_year' => '5',
			'count_waiting' => '0',
			'waitlist_enabled' => '0',
			'web_page' => 'http://www.no.capgemini.com/',
			'is_advertised' => '1',
			'logo' => 'http://bpc.timini.no/image/200/22.jpg',
		);
	}
}