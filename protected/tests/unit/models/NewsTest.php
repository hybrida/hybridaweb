<?php

class NewsTest extends PHPUnit_Framework_TestCase {

	private $session;

	public function __construct() {
		$this->session = new Session();
	}

	public function login() {
		$this->session->loginNewUser();
	}

	public function test_save_getAccess() {
		$this->login();
		$news = new News;
		$array = array(1, 2, 3);
		$news->setAccess($array);
		$news->save();
		$this->assertEquals($array, $news->getAccess());
	}

	public function test_save_getAuthor() {
		$this->login();
		$news = new News;
		$news->save();
		$userId = Yii::app()->user->id;
		$this->assertNotNull($userId);
		$this->assertEquals($userId, $news->author);
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$this->login();
		$array = array(1, 2, 3, 4, 5);
		$news = new News();
		$news->setAccess($array);
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->getAccess());
	}

	public function test_accessProperty() {
		$this->login();
		$news = new News();
		$array = array(1, 2, 3, 4, 5);
		$news->access = $array;
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->access);
	}

	public function test_accessIsLoadedOnFound() {
		$this->login();
		$news = new News;
		$access = array(1, 2, 4, 5);
		$news->access = $access;
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($access, $news2->access);
	}

	public function test_save_noInput_idNotNull() {
		$this->login();
		$news = new News;
		$news->save();
		$this->assertNotEquals(null, $news->id);
	}

	public function test_construct_noInput_idIsNull() {
		$this->login();
		$news = new News;
		$this->assertEquals(null, $news->id);
	}

	public function test_setParent_getParentId_TypeAndID() {
		$this->login();
		$event = new Event;
		$event->insert();
		$news = new News;
		$news->setParent("event", $event->getPrimaryKey());
		$news->insert();

		$news2 = News::model()->findByPk($news->id);

		$this->assertEquals($event->getPrimaryKey(), $news2->getParentId());
	}

	public function test_setParent_getParentType_TypeAndId() {

		$this->login();
		$event = new Event;
		$event->insert();
		$news = new News;
		$news->setParent("event", $event->getPrimaryKey());
		$news->insert();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals("event", $news2->getParentTYpe());
	}

	public function test_rules_tooLongTitle_false() {
		$this->login();
		$news = new News;
		$news->title = '_123456789_0123456789_123456789_123456789_123456789_123456789';
		$this->assertFalse($news->save());
	}

	public function test_rules_longestParentType_true() {
		$this->login();
		$news = new News;
		$news->title = __METHOD__;
		$news->parentType = '1234567';
		$this->assertTrue($news->save());
	}

	public function test_rules_tooLongParentType_false() {
		$this->login();
		$news = new News;
		$news->title = __METHOD__;
		$news->parentType = '12345678';
		$this->assertFalse($news->save());
	}
	
	public function test_authorIsNotSetOnUpdate() {
		$this->login();
		$news = new News;
		$news->title = "title";
		$news->save();
		$author = $news->author;
		$this->assertNotNull($author);
		
		$this->login();
		$news2 = News::model()->findByPk($news->id);
		$news2->content = "content";
		$news2->save();
		$this->assertEquals($news->author,$news2->author);
	}
	
	public function test_timestampSetOnCreate() {
		$this->login();
		$news = new News;
		$news->save();
		$this->assertNotNull($news->timestamp);
	}
}
