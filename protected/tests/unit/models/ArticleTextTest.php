<?php

class ArticleTextTest extends CTestCase {
	
	private function getNewArticle() {
		return Util::getNewArticle();
	}
	
	private function getArticle() {
		return Util::getArticle();
	}
	
	private function assertContentsCount($article, $expectedCount) {
		$sql = <<<SQL
			SELECT COUNT(*) as c
			FROM article_text
			WHERE articleId = :id
SQL;
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->bindValue(":id", $article->id);
		$stmt->execute();
		$ret = $stmt->fetch();
		$this->assertEquals($expectedCount, $ret[0]);
	}
	
	public function test_setContent_newArticleText() {
		$article = new Article;
		$article->setContent("test2");
		$this->assertNotNull($article->articleText);
	}
	
	public function test_setContent_articleTextIdAttributesIsNotNull() {
		$article = $this->getNewArticle();
		$article->setContent("This is the first content");
		$article->save();
		$articleTextId = $article->articleText->id;
		$this->assertNotNull($articleTextId);
		$this->assertEquals($article->articleTextId, $articleTextId);
	}

	public function test_save_unsavedArticle_newArticleText() {
		$article = $this->getNewArticle();
		$article->content = "This is the first content";
		$article->save();
		$this->assertContentsCount($article, 1);
	}
	
	public function test_save_changeContentMultipleTimes_newArticleTexts() {
		$article = $this->getNewArticle();
		$article->content = "This is the first content";
		$text = $article->articleText;
		$article->content = "Heisann";
		$text2 = $article->articleText;
		$this->assertNotEquals($text, $text2);
	}

	public function test_save_changeContentMultipleTimes_newArticleTextsInDatabase() {
		$article = $this->getArticle();
		$article->setContent(__METHOD__."Test2");
		$article->setContent(__METHOD__."Test3");
		$article->save();
		$this->assertContentsCount($article, 2);
		$article->setContent(__METHOD__."Test4");
		$article->save();
		$this->assertContentsCount($article, 3);
		$article->setContent("test5");
		$article->save();
		$this->assertContentsCount($article, 4);
	}

}