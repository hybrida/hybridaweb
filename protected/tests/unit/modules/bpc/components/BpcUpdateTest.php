<?php

Yii::import('bpc.BpcModule');
$module = new BpcModule;
$module->init();

class BpcUpdateTest extends CTestCase {

	public function test_updateAll_aNewBedpressIsFound_newsEventSignupCreated() {
		$update = new BpcUpdateMock;
		$update->updateAll();
		
		$bpcID = $update->id;
		$eventCompany = EventCompany::model()->find('bpcID = ?', array($bpcID));
		$this->assertNotNull($eventCompany);
		
		$event = Event::model()->findByPk($eventCompany->eventID);
		$this->assertNotNull($event);
		
		$signup = $event->getSignup();
		$this->assertNotNull($signup);
		
		$e = new Event;
		$news = News::model()->find('parentType = "event" AND parentID = ?', 
				array($event->id));
		$this->assertNotNull($news);
		
	}

}

class BpcUpdateMock extends BpcUpdate {
	
	public $id;

	protected function getBpcResponse($postdata) {
		$request = new BpcRequestMock($postdata);
		$request->send();
		$this->id = $request->id;
		return $request->getResponse();
	}

}

class BpcRequestMock extends BpcRequest {
	
	public $id;
	
	function __construct($postdata) {
		parent::__construct($postdata);
		$this->id = rand(0,100000);
	}

		public function getResponse() {
		return array(
			'event' =>
			array(
				0 =>
				array(
					'id' => $this->id,
					'title' => 'Capgemini',
					'description' => 'Capgemini',
					'description_formatted' => '<p>Capgemini</p>
',
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
					'min_year' => '1',
					'max_year' => '5',
					'count_waiting' => '0',
					'waitlist_enabled' => '0',
					'web_page' => 'http://www.no.capgemini.com/',
					'is_advertised' => '1',
					'logo' => 'http://bpc.timini.no/image/200/22.jpg',
				),
			),
		);
	}

	protected function sendRequest() {
		
	}

}

