<?php

class TestDb extends CTestCase {
	
	public function testConnection() {
		$this->assertNotEquals(Null, Yii::app()->db);
	}
	
	
}