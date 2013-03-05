<?php

class NewsTest extends CTestCase {

	private $session;

	public function __construct() {
		$this->session = new Session();
	}

	public function login() {
		$this->session->loginNewUser();
	}
	
	private function getNewNews() {
		return Util::getNewNews();
	}
	
	private function getNews() {
		return Util::getNews();
	}
	
	private function getNewEvent() {
		return Util::getNewEvent();
	}
	
	private function getEvent() {
		return Util::getEvent();
	}

	public function test_save_getAccess() {
		$this->login();
		$news = $this->getNewNews();
		$array = array(1, 2, 3);
		$news->setAccess($array);
		$news->save();
		$this->assertEquals($array, $news->getAccess());
	}

	public function test_save_getAuthor() {
		$this->login();
		$news = $this->getNews();
		$userId = Yii::app()->user->id;
		$this->assertNotNull($userId);
		$this->assertEquals($userId, $news->authorId);
	}

	public function test_accessGetterAndSetter_setAccess_inserted() {
		$this->login();
		$array = array(1, 2, 3, 4, 5);
		$news = $this->getNewNews();
		$news->setAccess($array);
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->getAccess());
	}

	public function test_accessProperty() {
		$this->login();
		$news = $this->getNewNews();
		$array = array(1, 2, 3, 4, 5);
		$news->access = $array;
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($array, $news2->access);
	}

	public function test_accessIsLoadedOnFound() {
		$this->login();
		$news = $this->getNewNews();
		$access = array(1, 2, 4, 5);
		$news->access = $access;
		$news->save();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals($access, $news2->access);
	}

	public function test_save_noInput_idNotNull() {
		$this->login();
		$news = $this->getNews();
		$this->assertNotEquals(null, $news->id);
	}

	public function test_construct_noInput_idIsNull() {
		$this->login();
		$news = $this->getNewNews();
		$this->assertEquals(null, $news->id);
	}

	public function test_setParent_getParentId_TypeAndID() {
		$this->login();
		$event = $this->getEvent();
		$news = $this->getNewNews();
		$news->setParent("event", $event->getPrimaryKey());
		$news->insert();

		$news2 = News::model()->findByPk($news->id);

		$this->assertEquals($event->getPrimaryKey(), $news2->getParentId());
	}

	public function test_setParent_getParentType_TypeAndId() {

		$this->login();
		$event = $this->getEvent();
		$news = $this->getNewNews();
		$news->setParent("event", $event->getPrimaryKey());
		$news->insert();

		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals("event", $news2->getParentTYpe());
	}

	public function test_rules_longestParentType_valid() {
		$this->login();
		$news = $this->getNewNews();
		$news->parentType = '1234567';
		$this->assertTrue($news->save());
	}

	public function test_rules_tooLongParentType_invalid() {
		$this->login();
		$news = $this->getNewNews();
		$news->parentType = '12345678';
		$this->assertFalse($news->save());
	}

	public function test_authorIdIsNotSetOnUpdate() {
		$this->login();
		$news = $this->getNews();
		$authorId = $news->authorId;
		$this->assertNotNull($authorId);

		$this->login();
		$news2 = News::model()->findByPk($news->id);
		$news2->content = "content";
		$news2->save();
		$this->assertEquals($news->authorId, $news2->authorId);
	}

	public function test_timestampSetOnCreate() {
		$this->login();
		$news = $this->getNews();
		$this->assertNotNull($news->timestamp);
	}
	
	public function test_purifier_content() {
		$this->login();
		$news = $this->getNewNews();
		$news->content = "tomrom<script></script>";
		$news->title = "test<script></script>";
		$news->purify();
		$news->save();
		
		$news2 = News::model()->findByPk($news->id);
		$this->assertEquals("tomrom",$news2->content);
		$this->assertEquals("test", $news2->title);
	}

}