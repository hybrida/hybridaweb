<?php

class ArticleTest extends CTestCase {
	
	private function getArticle() {
		$article = new Article();
		return $article;
	}

	public function test_construct() {
		$article = $this->getArticle();
		$article->save();
		$this->assertNotNull($article->primaryKey);
	}
	
	public function test_setAccess() {
		$access = array(1,2,3,4);
		$article = $this->getArticle();
		$article->access = $access;
		$article->save();
		
		$article2 = Article::model()->findByPk($article->primaryKey);
		$this->assertEquals($access, $article2->access);
	}
	
}
