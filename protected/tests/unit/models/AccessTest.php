<?php

class AccessTest extends CTestCase {


	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}


	public function testGetAccessRelation() {
		Access::deleteAllAccessRelation("event", 2);
		Access::insertAccessRelation( "event", 2, 4);
		Access::insertAccessRelation( "event", 2, 5);
		Access::insertAccessRelation( "event", 2, 6);
		Access::insertAccessRelation( "event", 2, 7);
		
		$expected = array(4,5,6,7);
		$this->assertEquals($expected, Access::getAccessRelation( "event",2));
		Access::deleteAllAccessRelation("event", 2);
	}

}
