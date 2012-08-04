<?php

Yii::import('bpc.BpcModule');
$module = new BpcModule('test', null);
$module->init();

class BpcUpdateTest extends CTestCase {

	private $bpcID;
	private $bedpress;
	private $eventCompany;

	public function setUp() {
		$this->bedpress = bedpress();
		$this->bpcID = $this->bedpress['id'];
	}
	
	private function update() {
		$update = new BpcUpdateMock;
		$update->setBpcRequestResponse($this->bedpress);
		$update->updateAll();
		$this->eventCompany = $this->getEventCompany();
	}

	private function getEventCompany() {
		return EventCompany::model()->find('bpcID = ?', array($this->bpcID));
	}

	public function test_updateAll_newBedpressIsFound_EventCompanyCreated() {
		$this->update();
		$this->assertNotNull($this->eventCompany);
	}

	public function test_updateAll_newBedpressIsFound_EventCreated() {
		$this->update();
		$event = Event::model()->findByPk($this->eventCompany->eventID);
		$this->assertNotNull($event);
		$this->assertEquals($this->bedpress['time'], $event->start);
		$this->assertEquals($this->bedpress['place'], $event->location);
	}

	public function test_updateAll_newBedpressIsFound_NewsCreated() {
		$this->update();
		$eventID = $this->eventCompany->eventID;
		$news = News::model()->find('parentType = "event" AND parentID = ?', array($eventID));
		$this->assertNotNull($news);
		$this->assertEquals($this->bedpress['description_formatted'], $news->content);
		$this->assertEquals('Bedpres: ' . $this->bedpress['title'], $news->title);
		$this->assertEquals($this->bedpress['description'], $news->ingress); // Ingressen er for liten
	}

	public function test_updateAll_newBedpressIsFound_SignupCreated() {
		$this->update();
		$eventID = $this->eventCompany->eventID;
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

	public function setBpcRequestResponse($bedpressArray) {
		$this->bedpress = $bedpressArray;
	}

	protected function getBpcResponse($postdata) {
		return array(
			'event' =>
			array(
				0 => $this->bedpress));
	}

}

function bedpress() {
	return array(
		'id' => rand(300,10000),
		'title' => 'Capgemini',
		'description' => 'Capgemini',
		'description_formatted' => '<p>Capgemini</p>
',
		'time' => '2012-09-13 18:15:00',
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