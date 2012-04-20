<?php

class EventTest extends CTestCase {
	
	public function getEventObject() {
		return Util::getNewEvent();
	}

	public function test_construct() {
		$event = $this->getEventObject();
		$this->assertTrue($event->save());
	}

	public function test_insert_() {
		$event = $this->getEventObject();
		$array = array(1, 2, 3);
		$event->setAccess($array);
		$event->save();
		$this->assertEquals($array, $event->getAccess());
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$array = array(1, 2, 3, 4, 5);
		$event = $this->getEventObject();
		$event->setAccess($array);
		$event->save();

		$event2 = Event::model()->findByPk($event->id);
		$this->assertEquals($array, $event2->getAccess());
	}

	public function test_accessProperty() {
		$event = $this->getEventObject();
		$array = array(1, 2, 3, 4, 5);
		$event->access = $array;
		$event->save();

		$event2 = Event::model()->findByPk($event->id);
		$this->assertEquals($array, $event2->access);
	}

	public function test_accessIsLoadedOnFound() {
		$event = $this->getEventObject();
		$access = array(1, 2, 4, 5);
		$event->access = $access;
		$event->save();

		$event2 = Event::model()->findByPk($event->id);
		$this->assertEquals($access, $event2->access);
	}

	public function test_save_noInput_idNotNull() {
		$event = $this->getEventObject();
		$event->save();
		$this->assertNotEquals(null, $event->id);
	}

	public function test_construct_noInput_idIsNull() {
		$event = $this->getEventObject();
		$this->assertEquals(null, $event->id);
	}

	/* */
}
