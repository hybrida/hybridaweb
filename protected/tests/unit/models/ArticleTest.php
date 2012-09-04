<?php

class ArticleTest extends CTestCase {

	private function getNewArticle() {
		return Util::getNewArticle();
	}

	private function getArticle() {
		return Util::getArticle();
	}

	public function test_construct() {
		$article = $this->getArticle();
		$this->assertNotNull($article->primaryKey);
	}

	public function test_setAccess() {
		$access = array(1, 2, 3, 4);
		$article = $this->getNewArticle();
		$article->access = $access;
		$article->save();

		$article2 = Article::model()->findByPk($article->primaryKey);
		$this->assertEquals($access, $article2->access);
	}

	public function test_getChildren() {
		$parent = $this->getNewArticle();
		$parent->save();
		$child1 = $this->getNewArticle();
		$child2 = $this->getNewArticle();
		$child1->parentId = $parent->id;
		$child2->parentId = $parent->id;
		$child1->save();
		$child2->save();

		$children = $parent->getChildren();
		$this->assertEquals(2, count($children));
		$this->assertEquals($children[0]->id, $child1->id);
	}

	public function test_unset_method() {
		$article1 = $this->getNewArticle();
		$article2 = $this->getNewArticle();
		$myArray = array($article1, $article2);
		$this->assertEquals(2, count($myArray));
		$key = array_search($article1, $myArray);
		unset($myArray[$key]);
		$this->assertEquals(1, count($myArray));
		while ($myArray) {
			$key = array_search($article2, $myArray);
			unset($myArray[$key]);
		}
		$this->assertEquals(0, count($myArray));
		$this->assertNotEquals(null, $myArray);
		$this->assertEquals(true, isset($myArray));
		$this->assertEquals(true, empty($myArray));
	}

	public function test_purify_addScriptTags_scriptTagsAreStripped() {
		$article = $this->getArticle();
		$illegal = "<h1>Hei</h1><script language='javascript'>alert('hei');</script>";
		$expected = "<h1>Hei</h1>";
		$article->setAttributes(array(
			'title' => $illegal,
			'content' => $illegal,
			'shorttitle' => $illegal,
		));
		$article->purify();
		$this->assertEquals($expected, $article->title);
		$this->assertEquals($expected, $article->content);
		$this->assertEquals($expected, $article->shorttitle);
	}

	public function test_purify_addStyleToContent_styleIsNotStripped() {
		$article = $this->getArticle();
		$style = "<h1>Hei</h1><style>h1 {font-size: 20px}</style>";
		$stripped = "<h1>Hei</h1>";
		$article->title = $style;
		$article->content = $style;
		$article->shorttitle = $style;
		$article->purify();
		$this->assertEquals($style, $article->content);
		$this->assertEquals($stripped, $article->title);
		$this->assertEquals($stripped, $article->shorttitle);
	}

}
