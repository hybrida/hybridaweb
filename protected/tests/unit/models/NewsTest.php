<?php

class NewsTest extends PHPUnit_Framework_TestCase {

	public function test_insert_() {
		$news = new News;
		$array = array(1, 2, 3);
		$news->setAccess($array);
		$news->save();
		$this->assertEquals($array, $news->getAccess());
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$array = array(1, 2, 3, 4, 5);
		$news = new News();
		$news->setAccess($array);
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->getAccess());
	}
	
	public function test_accessProperty() {
		$news = new News();
		$array = array(1, 2, 3, 4, 5);
		$news->access = $array;
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->access);
	}
	
	public function test_accessIsLoadedOnFound() {
		$news = new News;
		$access = array(1,2,4,5);
		$news->access = $access;
		$news->save();
		
		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($access, $news2->access);
	}

	public function test_save_noInput_idNotNull() {
		$news = new News;
		$news->save();
		$this->assertNotEquals(null, $news->id);
	}
	
	public function test_construct_noInput_idIsNull() {
		$news = new News;
		$this->assertEquals(null, $news->id);
	}
	
	public function test_setParent_getParentId_TypeAndID() {
		$event = new Event;
		$event->insert();
		$news = new News;
		$news->setParent("event",$event->getPrimaryKey());
		$news->insert();
		
		$news2 = News::model()->findByPk($news->id);
		
		$this->assertEquals($event->getPrimaryKey(), $news2->getParentId());		
	}
	public function test_setParent_getParentType_TypeAndId() {
		
		$event = new Event;
		$event->insert();
		$news = new News;
		$news->setParent("event",$event->getPrimaryKey());
		$news->insert();
		
		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals("event", $news2->getParentTYpe());
	}
}
