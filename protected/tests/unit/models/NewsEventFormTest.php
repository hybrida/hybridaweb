<?php /*
Hva som maa testes

SetUp
=====

Lager bruker aa teste mot
Lage gruppe og teste mot

Tester
======

Lagring opp mot database
========================

* Sjekke at den kaster exceptions
* Den lagrer riktig naar:
	bare news
	bare event
	bare event og news
	alle tre

* ikke lagrer
	event naar hasEvent = 0
	news naar hasNews = 0
	signup naar hasSignup = 0
	signup naar hasEvent = 0

Tilganger
=================
* Laster dem opp

* Forskjellige tilganger til forskjellige brukere
	Admin
		All tilgang
	Gruppesjef
		All tilgang paa gruppen
		Legge ut paa hovedsiden
		Redigere sine egne
	Bruker:
		Legge ut paa gruppesider
		Redigere sine egne paa gruppesider

*/


class NewsEventFormTest extends PHPUnit_Framework_TestCase {

	protected $model;
	private $adminUser;
	private $groupLeader;
	private $groupMember;

	protected function setUp() {
		$this->setUpEvent();
	}

	private function setUpEvent() {
		$this->event = Event::model();
		$this->model = new NewsEventForm($this->event);
	}

	private function setUpNews() {
		$this->news = News::model();
		$this->model = new NewsEventForm($this->news);
	}

	public function testMakeAdminUser() {
		$this->adminUser = new User;
		$this->adminUser->firstName = rand(0,100000);
		$this->adminUser->lastName = rand(0,100000);
		$this->adminUser->username = rand(0,100000);
		$this->adminUser->member = true;
		
		$this->adminUser->save();
		
		$this->assertNotEquals(null,$this->adminUser->id);
	}

	public function testMakeNewNewsWithAdminPermissions() {
		$this->markTestIncomplete();
	}

}