<?php

Yii::import('application.components.widgets.AccessField');

class AccessFieldTest extends CTestCase {

	public $accessField;

	public function setUp() {
		$this->accessField = new AccessField;
	}

	public function assertChecked($accessId, $sub = 0) {
		$this->assertEquals("checked", $this->accessField->getChecked($accessId, $sub));
	}

	public function assertNotChecked($accessId, $sub = 0) {
		$this->assertEquals("", $this->accessField->getChecked($accessId, $sub));
	}

	public function setAccess($accessArray) {
		$this->accessField->access = $accessArray;
	}

	public function test_getChecked_oneSubGroup_simpleArray() {
		$accessArray = array(1, 10, 100);
		$this->setAccess($accessArray);

		$this->assertChecked(1);
		$this->assertChecked(10);
		$this->assertChecked(100);
	}

	public function test_getChecked_oneSubGroup_advancedArray() {
		$accessArray = array(
			array(
				1, 2, 3, 10,
			),
		);
		$this->setAccess($accessArray);

		$this->assertChecked(1);
		$this->assertChecked(2);
		$this->assertChecked(3);
		$this->assertChecked(10);
	}

	public function test_getChecked_twoSubGroups() {
		$accessArray = array(
			array(1001, 2012),
			array(2013, 4014),
		);
		$this->setAccess($accessArray);

		$this->assertChecked(1001, 0);
		$this->assertChecked(2012, 0);
		$this->assertNotChecked(2013, 0);

		$this->assertChecked(2013, 1);
		$this->assertChecked(4014, 1);

		$this->assertNotChecked(4014, 9);
	}

}