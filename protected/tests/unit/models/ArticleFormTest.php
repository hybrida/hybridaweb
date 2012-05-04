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

	public function test_save_access_oldArticle_noAccessChange() {
		$access = array(1, 2, 3);
		$article = $this->getArticle();
		$article->access = $access;
		$article->save();
		$input = array(
		);

		$form = $this->getForm($article);
		$form->setAttributes($input);
		$form->save();

		$this->assertEquals($access, $form->getArticleModel()->access);
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
		$this->assertEquals("hei",$art->content);
		
	}
	public function test_getArticle() {
		$article = $this->getArticle();
		$form = $this->getForm($article);
		$this->assertEquals($article, $form->getArticleModel());
	}

}