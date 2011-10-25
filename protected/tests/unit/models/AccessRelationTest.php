<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessRelation
 *
 * @author sigurd
 */
class AccessRelationTest extends PHPUnit_Framework_TestCase {

	public function test_constructor_NewsModel_GetId() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$this->assertEquals($news->id, $access->getId());
	}

	public function test_constructor_NewsModel_getType() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$this->assertEquals("news", $access->getType());
	}

	public function test_constructor_EventModel_getType() {
		$event = new Event;
		$event->title = "dummy";
		$event->content = "dummy";
		$event->save();
		$access = new AccessRelation($event);
		$this->assertEquals("event", $access->getType());
	}

	public function test_constructor_ArticleModel_getType() {
		$article = new Article;
		$article->title = "halla,o";
		$article->content = "contetn WOHWO";
		$article->save();
		$access = new AccessRelation($article);

		$this->assertEquals("article", $access->getType());
	}

	/**
	 * @expectedException NullPointerException
	 */
	public function test_constructor_NullInput_throwException() {
		$access = new AccessRelation(null);
	}

	/**
	 *  @expectedException InvalidArgumentException
	 *  
	 */
	public function test_insert_UnsavedModel_throwsException() {
		$news = new News;
		$access = new AccessRelation($news);
		$access->insert(array(1, 2, 3, 4));
	}

	public function test_validates_UnsavedModel_returnsFalse() {
		$news = new News;
		$access = new AccessRelation($news);
		$this->assertFalse($access->validates());
	}

	public function test_insert_accessArray_getsPutInDatabase() {
		$accessArray = array(1, 2, 3, 4);
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->insert($accessArray);

		$news2 = News::model()->findByPk($news->id);
		$access2 = new AccessRelation($news2);

		$this->assertEquals($accessArray, $access2->get());
	}

	public function test_delete_deleteAllRows_GetsDeleted() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->insert(array(1, 2, 3, 4));
		$access->delete();
		$this->assertEquals(array(), $access->get());
	}

	public function test_insert_insertInNonEmpty_arraysGetsMerged() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$accessArray1 = array(1, 2, 3, 4);
		$access->insert($accessArray1);

		$accessArray2 = array(5, 6, 7, 8);
		$access->insert($accessArray2);

		$this->assertEquals(array_merge($accessArray1, $accessArray2), $access->get());
	}

	public function test_instert_duplicatedInsertion_insertsOnce() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->insert(array(1, 2, 3));
		$access->insert(array(1, 3, 8));

		$this->assertEquals(array(1, 2, 3, 8), $access->get());
	}

}

?>
