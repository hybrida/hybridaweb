<?php

class NewsTest extends PHPUnit_Framework_TestCase {

	public function test_insert_() {
		$news = new News;
		$array = array(1, 2, 3);
		$news->save();
		$news->setAccess($array);
		$this->assertEquals($array, $news->getAccess());
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$news = new News();
		$array = array(1, 2, 3, 4, 5);
		$news->save();
		$news->setAccess($array);

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->getAccess());
	}
	
	public function test_accessProperty() {
		$news = new News();
		$array = array(1, 2, 3, 4, 5);
		$news->save();
		$news->access = $array;

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->access);
	}

	public function test_save_noInput_idNotNull() {
		$news = new News;
		$news->save();
		$this->assertNotEquals(null, $news->id);
	}

}