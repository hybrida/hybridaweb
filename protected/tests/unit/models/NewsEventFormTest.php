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

	public function test_constructor_NewsInput_ModelIsSet() {
		$newsModel = new News;
		$model = new NewsEventForm($newsModel);
		$this->assertEquals($newsModel, $model->getNewsModel());
	}

	public function test_constructor_EventInput_ModelIsSet() {
		$eventModel = new Event;
		$model = new NewsEventForm($eventModel);
		$this->assertEquals($eventModel, $model->getEventModel());
	}

	public function test_constructor_NewsInput_EventModelIsCreated() {
		$newsModel = new News;
		$model = new NewsEventForm($newsModel);
	}

	public function test_saveNews_UnsavedNewsModelWithoutAccess_NewsIsCreated() {
		$news = new News;
		$model = new NewsEventForm($news);
		$model->hasNews = true;
		$model->saveNews();
		$this->assertNotEquals(null, $news->primaryKey);
	}

	public function test_saveNews_UnsavedNewsModelWitAccess_NewsIsCreated() {
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
		$model->saveNews();
		$this->assertEquals($title, $model->getNewsModel()->title);
		$this->assertEquals($contet, $model->getNewsModel()->content);
		$this->assertEquals($access, $model->getNewsModel()->access);
	}

}