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

	public function test_validates_UnsavedModel_returnsFalse() {
		$news = new News;
		$access = new AccessRelation($news);
		$this->assertFalse($access->validates());
	}

	/**
	 *  @expectedException BadMethodCallException
	 *  
	 */
	public function test_insert_UnsavedModel_throwsException() {
		$news = new News;
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3,));
		$access->insert();
	}

	public function test_insert_accessArray_getsPutInDatabase() {
		$accessArray = array(1, 2, 3, 4);
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->set($accessArray);
		$access->insert();

		$news2 = News::model()->findByPk($news->id);
		$access2 = new AccessRelation($news2);

		$this->assertEquals($accessArray, $access2->get());
	}

	public function test_insert_insertInNonEmpty_arraysGetsMerged() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$accessArray1 = array(1, 2, 3, 4);
		$access->set($accessArray1);
		$access->insert();

		$accessArray2 = array(5, 6, 7, 8);
		$access->set($accessArray2);
		$access->insert();

		$this->assertEquals(array_merge($accessArray1, $accessArray2), $access->get());
	}

	public function test_instert_duplicatedInsertion_insertsOnce() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3));
		$access->insert();
		$access->set(array(1, 3, 8));
		$access->insert();

		$this->assertEquals(array(1, 2, 3, 8), $access->get());
	}
	
	public function test_insert_makeAccessRelationOnNewRecord_throwsNothing() {
		$array = array(1,2,3);
		$news = new News;
		$access = new AccessRelation($news);
		$access->set($array);
		$news->save();
		$access->save();
	}
	
	public function test_insert_EmptyArray_doesNothing() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->set(array());
		$access->save();
		
		$news2 = News::model()->findByPk($news->id);
		$access = new AccessRelation($news2);
		$this->assertEquals(array(),$access->get());

	}

	public function test_save_nonEmptyAccess_deleteOld() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3, 4));
		$access->save();
		$array = array(5, 8);
		$access->set($array);
		$access->save();


		$news2 = News::model()->findByPk($news->id);
		$access2 = new AccessRelation($news2);

		$this->assertEquals($array, $access2->get());
	}


	public function test_delete_deleteAllRows_GetsDeleted() {
		$news = new News;
		$news->save();
		$access = new AccessRelation($news);
		$access->set(array(1, 2, 3, 4));
		$access->insert();
		$access->delete();
		$this->assertEquals(array(), $access->get());
	}

}
