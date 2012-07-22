<?php

class EventTest extends CTestCase {
	
	public function getNewEvent() {
		return Util::getNewEvent();
	}

	public function test_insert_() {
		$event = $this->getNewEvent();
		$array = array(1, 2, 3);
		$event->setAccess($array);
		$event->save();
		$this->assertEquals($array, $event->getAccess());
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$array = array(1, 2, 3, 4, 5);
		$event = $this->getNewEvent();
		$event->setAccess($array);
		$event->save();

		$event2 = Event::model()->findByPk($event->id);
		$this->assertEquals($array, $event2->getAccess());
	}

	public function test_accessProperty() {
		$event = $this->getNewEvent();
		$array = array(1, 2, 3, 4, 5);
		$event->access = $array;
		$event->save();

		$event2 = Event::model()->findByPk($event->id);
		$this->assertEquals($array, $event2->access);
	}

	public function test_accessIsLoadedOnFound() {
		$event = $this->getNewEvent();
		$access = array(1, 2, 4, 5);
		$event->access = $access;
		$event->save();

		$event2 = Event::model()->findByPk($event->id);
		$this->assertEquals($access, $event2->access);
	}

	public function test_save_noInput_idNotNull() {
		$event = $this->getNewEvent();
		$event->save();
		$this->assertNotEquals(null, $event->id);
	}

	public function test_construct_noInput_idIsNull() {
		$event = $this->getNewEvent();
		$this->assertEquals(null, $event->id);
	}
	
	public function test_saveBedpres_numberOfEventCompanyRowsIncreasesByOne() {
		$count = EventCompany::model()->count();
		$event = Util::getEvent();
		$event->saveBedpres(rand(0,10000000));
		$newCount = EventCompany::model()->count();
		
		$this->assertEquals($newCount, $count + 1, "The bedpress didn't get saved");
	}
	
	
	public function test_saveBedpres() {
		$randomNumber = rand(0,10000);
		$secondRandomNumber = rand(0,100);
		$event = $this->getNewEvent();
		$event->save();
		$event->saveBedpres($randomNumber, $secondRandomNumber);
		
		$event2 = Event::model()->findByPk($event->id);
		$bedpress = $event2->getBedpress();
		$this->assertEquals($randomNumber, $bedpress->bpcID);
	}
	
	public function test_saveBedpres_companyID_dont_change_when_saved_if_record_exists_and_companyID_isnt_specified() {
		$randomNumber = rand(0,10000);
		$randomNumber2 = rand(0,10000);
		$event = $this->getNewEvent();
		$event->save();
		$event->saveBedpres($randomNumber, $randomNumber2);
		
		$event2 = Event::model()->findByPk($event->id);
		$event2->saveBedpres($randomNumber);
		
		$event3 = Event::model()->findByPk($event->id);
		$bedpress = $event3->getBedpress();
		
		$this->assertEquals($randomNumber2, $bedpress->companyID);
	}
	
	public function test_saveBedpres_changeCompanyIDToNull() {
		$randomNumber = rand(0,10000);
		$randomNumber2 = rand(0,10000);
		$event = $this->getNewEvent();
		$event->save();
		$event->saveBedpres($randomNumber, $randomNumber2);
		
		$event2 = Event::model()->findByPk($event->id);
		$event2->saveBedpres($randomNumber, null);
		
		$event3 = Event::model()->findByPk($event->id);
		$bedpress = $event3->getBedpress();
		
		$this->assertEquals(null, $bedpress->companyID);
	}

}
