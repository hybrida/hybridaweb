<?php

class ArticleFormTest extends CTestCase {

	private function getArticle() {
		return Util::getArticle();
	}

	private function getNewArticle() {
		return Util::getNewArticle();
	}

	private function getForm($article) {
		return new ArticleForm($article);
	}

	public function test_fieldsAreSetCorrectly() {
		$title = "test123";
		$content = "content hey hey";
		$article = $this->getArticle();
		$article->title = $title;
		$article->content = $content;
		$form = $this->getForm($article);
		$this->assertEquals($title, $form->title);
		$this->assertEquals($content, $form->content);
	}

	public function test_fieldsAreSetCorrectly_containsPhpFile() {
		$article = $this->getArticle();
		$article->phpFile = "styret";
		$form = $this->getForm($article);
		$this->assertEquals("styret", $form->phpFile);
	}

	public function test_fieldsAreSetOnInput_phpFile() {
		$input = array(
			'phpFile' => 'styret2',
		);
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$form->setAttributes($input);
		$this->assertEquals("styret2", $form->phpFile);
	}


	public function test_fieldsAreSetOnInput() {
		$info = "sigurd";
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$input = array(
			'title' => $info,
			'content' => $info,
		);
		$form->setAttributes($input);
		$this->assertEquals($info, $form->title);
		$this->assertEquals($info, $form->content);
	}

	public function test_setUnvalidProperty() {
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$form->setAttributes(array(
			'aoweftnaot' => 3,
		));
	}

	public function test_accessFieldIsSetCorrectly() {
		$access = array(
			array(1, 2, 3, 4),
			array(5, 100, 1000),
		);
		$article = $this->getArticle();
		$article->access = $access;
		$article->save();
		$form = $this->getForm($article);
		$this->assertEquals($access, $form->access);
	}

	public function test_save() {
		$title = "test hei hei ";
		$content = "dette er litt innhold";
		$article = $this->getNewArticle();
		$input = array(
			'title' => $title,
			'content' => $content,
		);

		$form = $this->getForm($article);
		$form->setAttributes($input);
		$form->save();
		$this->assertEquals($title, $form->getArticleModel()->title);
		$this->assertEquals($content, $form->getArticleModel()->content);
	}

	public function test_save_phpFile() {
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$form->phpFile = "styret";
		$form->save();

		$article = Article::model()->findByPk($article->id);
		$this->assertEquals("styret", $article->phpFile);

	}

	public function test_save_access_newArticle() {
		$access = array(1, 2, 3);
		$article = $this->getNewArticle();
		$input = array(
			'access' => $access,
		);

		$form = $this->getForm($article);
		$form->setAttributes($input);
		$form->save();

		$this->assertEquals($access, $form->getArticleModel()->access);
	}

	public function test_save_deleteOldAccess() {
		$access = array(1, 2, 3, 4);
		$article = $this->getArticle();
		$article->access = $access;
		$article->save();
		$form = $this->getForm($article);
		$form->setAttributes(array(
			'content' => "halla",
			'title' => "heisann",
		));
		$form->save();

		$article2 = Article::model()->findByPk($article->id);
		$this->assertEmpty($article2->access);
	}

	public function test_save_purifiedOutput() {
		$content = "hei<script></script>";
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$form->setAttributes(array(
			'content' => $content,
		));
		$form->save();

		$art = Article::model()->findByPk($article->id);
		$content = $art->content;
		$this->assertEquals("hei", $content);
	}

	public function test_getArticle() {
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$this->assertEquals($article, $form->getArticleModel());
	}

}
