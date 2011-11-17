<?php

/*
  Hva som maa testes

  SetUp
  =====

  Lager bruker aa teste mot
  Lage gruppe og teste mot

  Tester
  ======

  Lagring opp mot database
  ========================

 * Sjekke at den kaster exceptions
 * Den lagrer riktig naar:
  bare news
  bare event
  bare event og news
  alle tre

 * ikke lagrer
  event naar hasEvent = 0
  news naar hasNews = 0
  signup naar hasSignup = 0
  signup naar hasEvent = 0

  Tilganger
  =================
 * Laster dem opp

 * Forskjellige tilganger til forskjellige brukere
  Admin
  All tilgang
  Gruppesjef
  All tilgang paa gruppen
  Legge ut paa hovedsiden
  Redigere sine egne
  Bruker:
  Legge ut paa gruppesider
  Redigere sine egne paa gruppesider

 */

class NewsEventFormTest extends PHPUnit_Framework_TestCase {

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

	public function test_constructor_NewsModel() {
		$newsModel = new News;
		$model = new NewsEventForm($newsModel);
		$this->assertEquals($newsModel, $model->getNewsModel());
	}

	public function test_constructor_EventModel() {
		$eventModel = new Event;
		$eventModel->title = "TestCase123";
		$model = new NewsEventForm($eventModel);
		$this->assertEquals($eventModel, $model->getEventModel());
	}

	public function test_constructor_NewsInput_EventModelIsCreated() {
		$newsModel = new News;
		$eventModel = new Event;
		$eventModel->content = $eventModel->title = "TestCase";
		$eventModel->save();
		$newsModel->setParent("event", $eventModel->id);
		$newsModel->save();
		$model = new NewsEventForm($newsModel);

		$this->assertNotEquals(null, $model->getEventModel());
		$this->assertEquals($eventModel->id, $model->getEventModel()->id);
	}

	public function test_constructor_EventInput_NewsModelIsCreated() {
		$newsModel = new News;
		$eventModel = new Event;
		$eventModel->content = $eventModel->title = "TestCase";
		$eventModel->save();
		$newsModel->setParent("event", $eventModel->getPrimaryKey());
		$newsModel->save();
		$model = new NewsEventForm($eventModel);

		$this->assertNotEquals(null, $model->getNewsModel());
		$this->assertEquals($newsModel->id, $model->getNewsModel()->id);
	}

	public function test_constructor_NewsInput_allModelsNotNull() {
		$model = new NewsEventForm(new News);
		$news = $model->getNewsModel();
		$event = $model->getEventModel();
		$signup = $model->getSignupModel();

		$this->assertNotEquals(null, $news);
		$this->assertNotEquals(null, $event);
		$this->assertNotEquals(null, $signup);
	}

	/**
	 * @expectedException NullPointerException
	 */
	public function test_constructor_nullInput_throwsException() {
		$model = new NewsEventForm(null);
		$this->assertTrue(false); // Hvis testen har kommet så langt burde den faile
	}

	public function test_construct_newsModel_FieldsAreUpdated() {
		$title = $content = "dummy";
		$access = array(1, 2, 3, 4, 5);
		$newsModel = new News;
		$newsModel->title = $title;
		$newsModel->content = $content;
		$newsModel->access = $access;
		$this->assertTrue($newsModel->save());

		$model = new NewsEventForm($newsModel);
		$this->assertEquals($title, $model->news['title']);
		$this->assertEquals($content, $model->news['content']);
		$this->assertEquals($access, $model->news['access']);
	}

	public function test_construct_eventModel_FieldsAreUpdated() {
		$title = $content = "dummy";
		$access = array(1, 2, 3, 4, 5);
		$eventModel = new Event;
		$eventModel->title = $title;
		$eventModel->content = $content;
		$eventModel->access = $access;
		$this->assertTrue($eventModel->save());

		$model = new NewsEventForm($eventModel);
		$this->assertEquals($title, $model->event['title']);
		$this->assertEquals($content, $model->event['content']);
		$this->assertEquals($access, $model->event['access']);
	}

	public function test_saveNews_UnsavedNewsModelWithoutAccess_NewsIsCreated() {
		$news = new News;
		$model = new NewsEventForm($news);
		$model->hasNews = true;
		$model->saveNews();
		$this->assertNotEquals(null, $news->getPrimaryKey());
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
		$model = new NewsEventForm(new News);
		$model->setAttributes($input);
		$model->hasNews = true;
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

		$model = new NewsEventForm(new News);
		$model->setAttributes($input);
		$model->hasNews = true;
		$model->saveNews();

		$this->assertEquals($title, $model->getNewsModel()->title);
		$this->assertEquals($content, $model->getNewsModel()->content);
		$this->assertEquals($access, $model->getNewsModel()->access);
	}

	public function test_setAttributes_eventModel_checkTitleContentAccess() {
		$title = $content = "dummy";
		$access = array(6, 7, 8,);
		$input = array(
			"event" => array(
				"title" => $title,
				"content" => $content,
				"access" => $access,
			),
		);

		$model = new NewsEventForm(new Event);
		$model->setAttributes($input);
		$model->hasEvent = true;
		$model->saveEvent();

		$this->assertEquals($title, $model->getEventModel()->title);
		$this->assertEquals($content, $model->getEventModel()->content);
		$this->assertEquals($access, $model->getEventModel()->access);
	}

	public function test_setAttributes_eventAndSignupModel_IDsAreTheSame() {
		$title = $content = "dummy";
		$access = array(1, 6, 7, 8,);
		$input = array(
			"event" => array(
				"title" => $title,
				"content" => $content,
				"access" => $access,
			),
			"signup" => array(
				"spots" => '1000',
				"open" => '2009-12-12',
				"close" => '2009-12-12',
				'access' => $access,
			),
		);

		$model = new NewsEventForm(new Event);
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
		$news = new News;

		$input = array(
			'news' => array(
				"title" => "heisann",
			),
			"event" => array(
				'title' => "hei",
			)
		);

		$model = new NewsEventForm($news);
		$model->setAttributes(($input));
		$model->hasNews = true;
		$model->hasEvent = true;
		$model->save();
		$eventModel = $model->getEventModel();
		$this->assertEquals($eventModel->id, $news->parentId);
		$this->assertEquals('event', $news->parentType);
	}

	public function test_attributesGetsLoaded() {
		$title = "TiTLE";
		$content = "CONTENT";
		$news = new News;
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
				$news = new News;

		$input = array(
			'news' => array(
				"title" => "heisann",
			),
			"event" => array(
				'title' => "hei",
			)
		);

		$model = new NewsEventForm($news);
		$model->setAttributes(($input));
		$model->hasNews = true;
		$model->hasEvent = true;
		$model->save();
		$eventModel = $model->getEventModel();
		$this->assertEquals($eventModel->id, $news->parentId);
		$this->assertEquals('event', $news->parentType);
		
	}

}