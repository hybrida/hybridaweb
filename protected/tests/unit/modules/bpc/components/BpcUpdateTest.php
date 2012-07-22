<?php

Yii::import('bpc.BpcModule');
$module = new BpcModule('test', null);
$module->init();

class BpcUpdateTest extends CTestCase {

	private $bpcID;
	private $bedpress;

	public function setUp() {
		$update = new BpcUpdateMock;
		$update->updateAll();
		$this->bpcID = $update->id;
		$this->bedpress = $update->bedpress;
	}

	private function getEventCompany() {
		return EventCompany::model()->find('bpcID = ?', array($this->bpcID));
	}

	public function test_updateAll_newBedpressIsFound_EventCompanyCreated() {
		$eventCompany = $this->getEventCompany();
		$this->assertNotNull($eventCompany);
	}

	public function test_updateAll_newBedpressIsFound_EventCreated() {
		$eventCompany = $this->getEventCompany();
		$event = Event::model()->findByPk($eventCompany->eventID);
		$this->assertNotNull($event);
		$this->assertEquals($this->bedpress['time'], $event->start);
		$this->assertEquals($this->bedpress['place'], $event->location);
	}

	public function test_updateAll_newBedpressIsFound_NewsCreated() {
		$eventID = $this->getEventCompany()->eventID;
		$news = News::model()->find('parentType = "event" AND parentID = ?', array($eventID));
		$this->assertNotNull($news);
		$this->assertEquals($this->bedpress['description_formatted'], $news->content);
		$this->assertEquals('Bedpres: ' . $this->bedpress['title'], $news->title);
		$this->assertEquals($this->bedpress['description'], $news->ingress); // Ingressen er for liten
	}

	public function test_updateAll_newBedpressIsFound_SignupCreated() {
		$eventID = $this->getEventCompany()->eventID;
		$signup = Signup::model()->findByPk($eventID);
		$this->assertNotNull($signup);
		$this->assertEquals($this->bedpress['deadline'], $signup->close);
		$this->assertEquals($this->bedpress['registration_start'], $signup->open);
		$this->assertEquals(Status::DELETED, $signup->status);
	}

}

class BpcUpdateMock extends BpcUpdate {

	public $id;
	public $bedpress;

	protected function getBpcResponse($postdata) {
		$request = new BpcRequestMock($postdata);
		$request->send();
		$this->id = $request->id;
		$this->bedpress = $request->bedpress();
		return $request->getResponse();
	}

}

class BpcRequestMock extends BpcRequest {

	public $id;

	function __construct($postdata) {
		parent::__construct($postdata);
		$this->id = rand(0, 100000);
	}

	public function getResponse() {
		return array(
			'event' => array(0 => $this->bedpress()),
		);
	}

	public function bedpress() {
		return array(
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
		);
	}

	protected function sendRequest() {
		
	}

}

