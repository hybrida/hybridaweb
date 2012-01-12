<?php

class NewsFeedTest extends CTestCase {

	private $dummyDataLength = 100;

	public function __construct() {
		$this->createDummyData();
	}

	private function createDummyData() {
		for ($i = 0; $i < $this->dummyDataLength; $i++) {
			if ($i % 5 == 0) {
				$this->createUnvisibleDummyData();
			} else {
				$this->createVisibleDummyData();
			}
		}
	}

	private function createUnvisibleDummyData() {
		$news = new News;
		$news->title = "title";
		$news->access = array(1000000,);
		$this->assertTrue($news->save());
	}

	private function createVisibleDummyData() {
		$news = new News;
		$news->title = News::model()->count();
		$news->access = array();
		$this->assertTrue($news->save());
	}

	public function _test_getElements_size() {
		$limit = 5;
		$feed = new NewsFeed($limit);
		$elements = $feed->getElements();
		$this->assertEquals($limit, count($elements));
	}

	public function test_getElements_access() {
		$limit = 23;
		$feed = new NewsFeed($limit);
		$elements = $feed->getElements();
		$gk = new GateKeeper;
		foreach ($elements as $e) {
			$this->assertTrue($gk->hasAccess('news', $e->id));
		}
	}
	
	public function test_getElements_activeRecord() {
		$limit = 10;
		$feed = new NewsFeed($limit);
		$elements = $feed->getElements();
		foreach ($elements as $e) {
			$this->assertInstanceOf('CActiveRecord', $e);
		}
	}

	// README: denne testen kan ta lang tid.
	public function _test_getElements_tooHighLimit_getAllElements() {
		$limit = 1e10;
		$feed = new NewsFeed($limit);
		$elements = $feed->getElements();
		$this->assertTrue(count($elements) < $limit);
	}
	
	public function test_getLimit() {
		$limit = 15;
		$feed = new NewsFeed($limit);
		$this->assertEquals($limit, $feed->getLimit());
	}
	
	public function test_getOffset() {
		$offset = 15;
		$limit = 10;
		$feed = new NewsFeed($limit, $offset);
		$this->assertEquals($offset, $feed->getOffset());
	}
	
	public function test_getOffset_offsetIncrementsByLimitForeachGetElements() {
		$limit = 10;
		$feed = new NewsFeed($limit);
		$feed->getElements();
		$this->assertEquals($limit, $feed->getOffset());
		$feed->getElements();
		$this->assertEquals($limit * 2, $feed->getOffset());
	}

}