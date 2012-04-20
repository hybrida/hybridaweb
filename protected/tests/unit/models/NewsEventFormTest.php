<?php

class NewsEventFormTest extends CTestCase {

	private $session;

	private function login() {
		if (!$this->session)
			$this->session = new Session();
		$this->session->loginNewUser();
	}

	private function logout() {
		if (!$this->session) {
			$this->session = new Session();
		}
		$this->session->logout();
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

	public function test_constructor_NewsModel() {
		$newsModel = $this->getNewNews();
		$model = new NewsEventForm($newsModel);
		$this->assertEquals($newsModel, $model->getNewsModel());
	}

	public function test_constructor_NewsInput_EventModelIsCreated() {
		$newsModel = $this->getNewNews();
		$eventModel = $this->getNewEvent();
		$eventModel->title = "title";
		$eventModel->save();
		$newsModel->setParent("event", $eventModel->id);
		$newsModel->save();
		$model = new NewsEventForm($newsModel);

		$this->assertNotNull($model->getEventModel());
		$this->assertEquals($eventModel->id, $model->getEventModel()->id);
	}

	public function test_constructor_NewsInput_allModelsNotNull() {
		$model = new NewsEventForm($this->getNewNews());
		$news = $model->getNewsModel();
		$event = $model->getEventModel();
		$signup = $model->getSignupModel();

		$this->assertNotNull($news);
		$this->assertNotNull($event);
		$this->assertNotNull($signup);
	}

	public function test_construct_newsModel_FieldsAreUpdated() {
		$title = $content = "dummy";
		$access = array(1, 2, 3, 4, 5);
		$newsModel = $this->getNewNews();
		$newsModel->title = $title;
		$newsModel->content = $content;
		$newsModel->access = $access;
		$this->assertTrue($newsModel->save());

		$model = new NewsEventForm($newsModel);
		$this->assertEquals($title, $model->news['title']);
		$this->assertEquals($content, $model->news['content']);
		$this->assertEquals($access, $model->news['access']);
	}

	public function test_construct_newsModel_EventFieldsAreUpdated() {
		$title = "dummy";
		$access = array(1, 2, 3, 4, 5);
		$eventModel = $this->getNewEvent();
		$eventModel->title = $title;
		$eventModel->access = $access;
		$this->assertTrue($eventModel->save());

		$news = $this->getNews();
		$news->setParent('event', $eventModel->id);

		$model = new NewsEventForm($news);
		$this->assertEquals($title, $model->event['title']);
		$this->assertEquals($access, $model->event['access']);
	}

	public function test_saveNews_UnsavedNewsModelWithoutAccess_NewsIsCreated() {
		$news = $this->getNewNews();
		$model = new NewsEventForm($news);
		$model->saveNews();
		$this->assertNotNull($news->getPrimaryKey());
	}

	public function test_newsSave() {
		$this->login();
		$news = $this->getNewNews();
		$model = new NewsEventForm($news);
		$model->save();
		$this->assertFalse($model->getNewsModel()->isNewRecord);
	}

	public function test_saveNews_UnsavedNewsModelWitAccess() {
		$title = $content = "dummy";
		$access = array(1, 2, 3, 4);
		$input = array(
			"news" => array(
				"title" => $title,
				"content" => $content,
				"access" => $access,
			)
		);
		$model = new NewsEventForm($this->getNewNews());
		$model->setAttributes($input);
		$model->saveNews();
		$news = $model->getNewsModel();

		$this->assertEquals($title, $news->title);
		$this->assertEquals($content, $news->content);
		$this->assertEquals($access, $news->getAccess());
	}

	public function test_setAttributes_newsModel_checkTitleContentAccess() {
		$title = $content = "dummy";
		$access = array(6, 7, 8,);
		$input = array(
			"news" => array(
				"title" => $title,
				"content" => $content,
				"access" => $access,
			),
		);

		$model = new NewsEventForm($this->getNewNews());
		$model->setAttributes($input);
		$model->saveNews();

		$this->assertEquals($title, $model->getNewsModel()->title);
		$this->assertEquals($content, $model->getNewsModel()->content);
		$this->assertEquals($access, $model->getNewsModel()->access);
	}

	public function test_setAttributes_newsModel_checkEventTitleContentAccess() {
		$title = "dummy";
		$access = array(6, 7, 8,);
		$input = array(
			"event" => array(
				"title" => $title,
				"access" => $access,
			),
		);

		$model = new NewsEventForm($this->getNewNews());
		$model->setAttributes($input);
		$model->hasEvent = true;
		$model->saveEvent();

		$this->assertEquals($title, $model->getEventModel()->title);
		$this->assertEquals($access, $model->getEventModel()->access);
	}

	public function test_setAttributes_eventAndSignupModel_IDsAreTheSame() {
		$title = $content = "dummy";
		$access = array(1, 6, 7, 8,);
		$input = array(
			"event" => array(
				"title" => $title,
				"access" => $access,
			),
			"signup" => array(
				"spots" => '1000',
				"open" => '2009-12-12',
				"close" => '2009-12-12',
				'access' => $access,
			),
		);

		$model = new NewsEventForm($this->getNewNews());
		$model->setAttributes($input);
		$model->hasEvent = true;
		$model->hasSignup = true;
		$model->saveEvent();
		$model->saveSignup();

		$signupId = $model->getSignupModel()->getPrimaryKey();
		$eventId = $model->getEventModel()->getPrimaryKey();
		$this->assertEquals($signupId, $eventId);
	}

	public function test_saveParent_newModel() {
		$this->login();
		$news = $this->getNewNews();

		$input = array(
			'news' => array(
				"title" => "title",
			),
			"event" => array(
				'title' => "title",
			)
		);

		$model = new NewsEventForm($news);
		$model->setAttributes($input);
		$model->hasEvent = 1;
		$model->save();
		$eventModel = $model->getEventModel();
		$this->assertEquals($eventModel->id, $news->parentId);
		$this->assertEquals('event', $news->parentType);
	}

	public function test_saveParent_oldModel() {
		$this->login();
		$news = $this->getNewNews();
		$news->title = $news->content = __METHOD__;
		$news->save();

		$input = array(
			'news' => array(
				'title' => 'title',
			),
			'event' => array(
				'location' => "location"
			),
			'hasEvent' => 1,
			'hasSignup' => 0,
		);

		$model = new NewsEventForm($news);
		$model->setAttributes($input);
		$model->save();
		$event = $model->getEventModel();
		$news2 = $model->getNewsModel();
		$this->assertEquals($event->id, $news2->parentId);
		$this->assertEquals('event', $news2->parentType);
		$this->assertFalse($news->isNewRecord, "Event kan ikke være en new record");
		$this->assertFalse($event->isNewRecord, "News kan ikke være en new record");
	}

	public function test_hasSignup_signupsIsFoundOnCreate() {
		$this->login();
		// Lage ny post;
		$model = new NewsEventForm($this->getNewNews());
		$input = array(
			'news' => array(
				'title' => 'title',
			),
			'event' => array(
				'begin' => '2011-11-30 20:55:26',
				'end' => '2011-11-30 20:55:26',
			),
			'signup' => array(
				'spots' => 100,
				'open' => '2011-11-30 20:55:26',
				'close' => '2011-11-30 20:55:26',
			),
			'hasEvent' => 1,
			'hasSignup' => 1,
		);
		$model->attributes = $input;
		$model->save();

		// De ble lagret
		$this->assertFalse($model->getEventModel()->isNewRecord);
		$this->assertFalse($model->getNewsModel()->isNewRecord);
		$this->assertFalse($model->getSignupModel()->isNewRecord);

		// De ble hentet riktig
		$model2 = new NewsEventForm($model->getNewsModel());
		$this->assertFalse($model2->getEventModel()->isNewRecord);
		$this->assertFalse($model2->getNewsModel()->isNewRecord);
		$this->assertFalse($model2->getSignupModel()->isNewRecord);
	}

	public function test_attributesGetsLoaded() {
		$title = "title";
		$content = "CONTENT";
		$news = $this->getNewNews();
		$news->title = $title;
		$news->content = $content;
		$news->save();

		$model = new NewsEventForm($news);
		$this->assertEquals($title, $model->news['title']);
		$this->assertEquals($content, $model->news['content']);
	}

	/**
	 * @expectedException CHttpException
	 */
	public function test_saveWhenNotLoggedIn_AccessRestrictionError() {
		$this->logout();
		$news = $this->getNewNews();

		$input = array(
			'news' => array(
				"title" => "title",
			),
			"event" => array(
				'title' => "title",
			)
		);

		$model = new NewsEventForm($news);
		$model->setAttributes(($input));
		$model->hasEvent = true;
		$model->save();
		$eventModel = $model->getEventModel();
		$this->assertEquals($eventModel->id, $news->parentId);
		$this->assertEquals('event', $news->parentType);
	}

	public function test_getEventModel_newsSetParentEvent_newsInput() {
		$event = $this->getNewEvent();
		$event->save();
		$news = $this->getNewNews();
		$news->setParent("event", $event->id);
		$news->save();
		$model = new NewsEventForm($news);
		$this->assertEquals($event->id, $model->getEventModel()->id);
	}

	public function test_getNewsModel_newsSetParentEvent_newsInput() {
		$event = $this->getNewEvent();
		$event->title = "TestCase";

		$event->save();
		$this->assertFalse($event->isNewRecord, "Event should not be newRecords");
		$news = $this->getNewNews();
		$news->setParent("event", $event->id);
		$news->save();
		$this->assertFalse($news->isNewRecord, "News should not be newRecord");
		$model = new NewsEventForm($news);
		$this->assertEquals($news->id, $model->getNewsModel()->id);
	}

	public function test_hasEvent_newRecord() {
		$model = new NewsEventForm($this->getNewNews());
		$this->assertEquals(0, $model->hasEvent);
	}

	public function test_has_formByNews() {
		$news = $this->getNewNews();
		$event = $this->getNewEvent();
		$event->title = "title";
		$event->save();
		$news->setParent("event", $event->id);
		$news->save();
		$model = new NewsEventForm($news);
		$this->assertEquals(1, $model->hasEvent, "hasEvent should be 1");
		$this->assertEquals(0, $model->hasSignup, "hasSignup should be 0");
	}

	public function test_has_formByEvent() {
		$news = $this->getNewNews();
		$event = $this->getNewEvent();
		$event->title = "title";
		$event->save();
		$news->setParent("event", $event->id);
		$news->save();
		$model = new NewsEventForm($news);

		$this->assertEquals(1, $model->hasEvent, "hasEvent should be 1");
		$this->assertEquals(0, $model->hasSignup, "hasSignup should be 0");
	}

	public function test_NewsHasNonExistingParents_actLikeNewsHasNoParents() {
		$news = $this->getNewNews();
		$news->title = "title";
		$news->content = "content";
		$news->authorId = 381;
		$news->setParent("event", 98765);
		$news->save();

		$model = new NewsEventForm($news);
		// Should not throw Exception
	}

	private function getDeleteEventTest() {
		$this->login();
		$news = $this->getNews();
		$event = $this->getEvent();
		$news->setParent('event', $event->id);
		$news->save();
		$model = new NewsEventForm(News::model()->findByPk($news->id));
		$model->attributes = array(
			'hasNews' => true,
			'hasEvent' => false,
		);
		$model->save();
		$news = News::model()->findByPk($news->id);
		$event = Event::model()->findByPk($event->id);
		return array($model, $news, $event);
	}

	public function test_deleteEvent_eventStatus_DELETED() {
		list($model, $news, $event) = $this->getDeleteEventTest();
		$this->assertEquals(Status::DELETED, $event->status);
	}

	private function getSignup($eventId) {
		$signup = new Signup;
		$signup->eventId = $eventId;
		$signup->spots = 100;
		$signup->close = $signup->open = '2011-12-12 22:30';

		$this->assertTrue($signup->save(), "signup save");
		return $signup;
	}

	public function getDeleteSignupTest() {
		$this->login();
		$event = $this->getEvent();
		$signup = $this->getSignup($event->id);
		$news = $this->getNews();
		$news->setParent('event', $event->id);
		$model = new NewsEventForm($news);
		$model->attributes = array(
			'hasEvent' => true,
			'hasSignup' => false,
		);
		$model->save();
		$signup = Signup::model()->findByPk($signup->eventId);
		return array($model, $news, $event, $signup);
	}

	public function test_deleteSignup_signupStatus_0() {
		list($model, $news, $event, $signup) = $this->getDeleteSignupTest();
		$this->assertEquals(Status::DELETED, $signup->status);
	}

	private function getEventAndSignupIsDeleted() {
		$event = $this->getEvent();
		$event->status = Status::DELETED;
		$event->save();

		$news = $this->getNews();
		$news->setParent('event', $event->id);
		$news->save();

		$signup = $this->getSignup($event->id);
		$signup->status = Status::DELETED;
		$signup->save();

		$model = new NewsEventForm($news);
		return array($model, $news, $event, $signup);
	}

	public function test_EventIsDeleted_hasEvent_false() {
		list($model, $news, $event, $signup) = $this->getEventAndSignupIsDeleted();
		$this->assertEquals(0, $model->hasEvent);
	}

	public function test_EventIsDeleted_hasSignup_false() {
		list($model, $news, $event, $signup) = $this->getEventAndSignupIsDeleted();
		$this->assertEquals(0, $model->hasSignup);
	}

	private function getNoDeletingOfNewRecords() {
		$this->login();
		$model = new NewsEventForm($this->getNews());
		$model->attributes = array(
			'hasEvent' => false,
			'hasSignup' => false,
		);
		$model->save();
		return $model;
	}

	public function test_NoDeletingOfNewRecords_event() {
		$model = $this->getNoDeletingOfNewRecords();
		$this->assertTrue($model->getEventModel()->isNewRecord);
	}

	public function test_NoDeletingOfNewRecords_signup() {
		$model = $this->getNoDeletingOfNewRecords();
		$this->assertTrue($model->getSignupModel()->isNewRecord);
	}

}