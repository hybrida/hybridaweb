<?php

class NewsTest extends CTestCase {

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
		$this->assertEquals($userId, $news->authorId);
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
	
	public function test_authorIdIsNotSetOnUpdate() {
		$this->login();
		$news = new News;
		$news->title = "title";
		$news->save();
		$authorId = $news->authorId;
		$this->assertNotNull($authorId);
		
		$this->login();
		$news2 = News::model()->findByPk($news->id);
		$news2->content = "content";
		$news2->save();
		$this->assertEquals($news->authorId,$news2->authorId);
	}
	
	public function test_timestampSetOnCreate() {
		$this->login();
		$news = new News;
		$news->save();
		$this->assertNotNull($news->timestamp);
	}
	
	public function test_getUrl_News() {
		$news = new News;
		$news->title = "title";
		$news->content = "content";
		$news->save();
		
		$expectedUrl = Yii::app()->createUrl("news/view",array("id" => $news->id));
		$actual = $news->getViewUrl();
		$this->assertEquals($expectedUrl, $actual);
	}
	
	public function test_getUrl_Event() {
		$event = new Event;
		$event->save(false);
		$news = new News;
		$news->setParent("event", $event->id);
		$news->save();
		
		$url = Yii::app()->createUrl("event/view",array("id" => $event->id));
		$this->assertEquals($url,$news->getViewUrl());
	}
}
