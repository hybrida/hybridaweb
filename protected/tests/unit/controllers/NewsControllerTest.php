<?php

require_once dirname(__FILE__) . '/../../../controllers/NewsController.php';

/**
 * Test class for NewsController.
 * Generated by PHPUnit on 2011-11-02 at 01:22:15.
 */
class NewsControllerTest extends PHPUnit_Framework_TestCase {
	
	public function __construct() {
		
	}

	public function test_getNewsModel_idExists () {
		$news = new News;
		$news->title = "dummy title";
		$news->content = "dummy content";
		
		
		$news->save();
		
		$controller = new NewsController(2);
		$this->assertNotEquals(null, $news->id);
		$this->assertEquals($news->id, $controller->getNewsModel($news->id)->id);
	}
	
	public function test_getNewsModel_idDoesNotExist() {
		$news = new News;
		
		$controller = new NewsController(2);
		$nonExistingId = 214234;
		$this->assertNotNull($controller->getNewsModel($nonExistingId));
	}
	
	public function test_getNewsModel_idIsNull() {
		$controller = new NewsController(2);
		$this->assertNotNull($controller->getNewsModel(null));
	}
	
	
	
}

?>
