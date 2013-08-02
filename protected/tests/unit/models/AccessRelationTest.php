<?php

class AccessRelationTest extends CTestCase {

	private function getNewNews() {
		return Util::getNewNews();
	}

	private function getNews() {
		return Util::getNews();
	}

	private function getEvent() {
		return Util::getEvent();
	}

	private function getArticle() {
		return Util::getArticle();
	}

	public function test_constructor_NewsModel_GetId() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$this->assertEquals($news->id, $access->getId());
	}

	public function test_constructor_NewsModel_getType() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$this->assertEquals("news", $access->getType());
	}

	public function test_constructor_EventModel_getType() {
		$event = $this->getEvent();
		$access = new AccessRelation($event);
		$this->assertEquals("event", $access->getType());
	}

	public function test_constructor_ArticleModel_getType() {
		$article = $this->getArticle();
		$access = new AccessRelation($article);

		$this->assertEquals("article", $access->getType());
	}

	public function test_constructor_TypeAndId_getType() {
		$access = new AccessRelation("news", 2);
		$this->assertEquals("news", $access->getType());
	}

	public function test_get_NonExistingModel_emptyArray() {
		$access = new AccessRelation("news", -142654);
		$this->assertEquals(array(), $access->get());
	}

	/**
	 * @expectedException NullPointerException
	 */
	public function test_constructor_NullInput_throwException() {
		$access = new AccessRelation(null);
	}

	public function test_validate_UnsavedModel_returnsFalse() {
		$news = $this->getNewNews();
		$access = new AccessRelation($news);
		$this->assertFalse($access->validate());
	}

	/**
	 *  @expectedException BadMethodCallException
	 */
	public function test_insert_UnsavedModel_throwsException() {
		$news = $this->getNewNews();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3,));
		$access->insert();
	}

	public function test_insert_accessArray() {
		$accessArray = array(1, 2, 3, 4);
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set($accessArray);
		$access->insert();

		$news2 = News::model()->findByPk($news->id);
		$access2 = new AccessRelation($news2);

		$this->assertEquals($accessArray, $access2->get());
	}

	public function test_insert_insertInNonEmpty_arraysGetsMerged() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$accessArray1 = array(1, 2, 3, 4);
		$access->set($accessArray1);
		$access->insert();

		$accessArray2 = array(5, 6, 7, 8);
		$access->set($accessArray2);
		$access->insert();

		$this->assertEquals(array_merge($accessArray1, $accessArray2), $access->get());
	}

	public function test_insert_duplicatedInsertion_insertsOnce() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3));
		$access->insert();
		$access->set(array(1, 3, 8));
		$access->insert();

		$this->assertEquals(array(1, 2, 3, 8), $access->get());
	}

	public function test_insert_duplicatedInsertionInSameSet_insertOnce() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3, 1, 2));
		$access->insert();

		$this->assertEquals(array(1, 2, 3), $access->get());
	}

	public function test_insert_duplicatedInsertionSeparateObjects() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3));
		$access->insert();

		$news2 = News::model()->findByPk($news->id);
		$access2 = new AccessRelation($news2);
		$access2->set(array(1, 3, 8));
		$access2->insert();

		$accessGet = new AccessRelation($news);

		$this->assertEquals(array(1, 2, 3, 8), $accessGet->get());
	}

	public function test_insert_makeAccessRelationOnNewRecord_throwsNothing() {
		$array = array(1, 2, 3);
		$news = $this->getNewNews();
		$access = new AccessRelation($news);
		$access->set($array);
		$news->save();
		$access->replace();

		// Hvis testen har kommet så langt
		// betyr det at den ikke har kastet none exception
		$this->assertTrue(true);
	}

	public function test_insert_EmptyArray_doesNothing() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set(array());
		$access->replace();

		$news2 = News::model()->findByPk($news->id);
		$access = new AccessRelation($news2);
		$this->assertEquals(array(), $access->get());
	}

	public function test_insert_constructedWithTypeAndId() {
		$array = array(1, 2, 3, 4);
		$access = new AccessRelation("event", 2);
		$access->set($array);
		$access->insert();

		$access2 = new AccessRelation("event", 2);
		$this->assertEquals($array, $access2->get());
	}

	public function test_save_nonEmptyAccess_deleteOld() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3, 4));
		$access->replace();
		$array = array(5, 8);
		$access->set($array);
		$access->replace();

		$news2 = News::model()->findByPk($news->id);
		$access2 = new AccessRelation($news2);

		$this->assertEquals($array, $access2->get());
	}

	public function test_removeAll() {
		$news = $this->getNews();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3, 4));
		$access->insert();
		$access->removeAll();

		$access2 = new AccessRelation($news);
		$this->assertEmpty($access->get());
	}

	public function test_save_noInputIsJustLikeInsert() {
		$array = array(1, 2, 3, 4, 5);
		$news = $this->getNews();

		$access = new AccessRelation($news);
		$access->set($array);
		$access->save();

		$access2 = new AccessRelation($news);
		$access2->save();

		$this->assertEquals($array, $access2->get());
	}

	public function test_save_twoAccessSubGroups() {
		$postAccess = array(
			array(2, 3, 1001),
			array(2, 3, 2012),
		);
		$news = $this->getNews();
		$ar = new AccessRelation($news);
		$ar->set($postAccess);
		$ar->save();

		$ar2 = new AccessRelation($news);
		$this->assertEquals($postAccess, $ar->get(), "he");
	}

	public function test_save_threeAccessSubGroups() {
		$postAccess = array(
			array(1, 2, 15, 4000),
			array(1, 2, 15, 4000),
			array(2, 3, 2012),
		);

		$news = $this->getNews();
		$ar = new AccessRelation($news);
		$ar->set($postAccess);
		$ar->save();
		$this->assertEquals($postAccess, $ar->get());
	}

	public function test_save_emptySubGroups() {
		$postAccess = array(
			array(),
			array(),
		);
		$news = $this->getNews();
		$ar = new AccessRelation($news);
		$ar->set($postAccess);
		$ar->save();
		$this->assertEquals(array(), $ar->get());
	}

	public function test_save_notOrderedInput() {
		$postAccess = array(
			1001 => 1001,
			2012 => 2012,
		);
		$expexted = array(
			1001, 2012,
		);
		$news = $this->getNews();
		$ar = new AccessRelation($news);
		$ar->set($postAccess);
		$ar->save();
		$this->assertEquals($expexted, $ar->get());
	}

}