<?php

class ArticleForm extends CFormModel {

	private $_article;
	private $_articleText;
	public $access = array();
	public $author;
	public $content;
	public $articleTextId;
	public $parentId;
	public $shorttitle;
	public $title;
	public $phpFile;

	public function __construct(Article $article, $scenario = '') {
		parent::__construct($scenario);

		if ($article == null) {
			throw new NullPointerException("articleinput was null");
		}

		$this->_article = $article;
		$this->_articleText = new ArticleText;
		$this->initAttributes();
	}

	private function initAttributes() {
		$this->title = $this->_article->title;
		$this->content = $this->_article->content;
		$this->articleTextId = $this->_articleText->id;
		$this->parentId = $this->_article->parentId;
		$this->shorttitle = $this->_article->shorttitle;
		$this->access = $this->_article->access;
		$this->phpFile = $this->_article->phpFile;
	}

	public function save() {
		$this->setArticleAttributes();
		$this->_article->purify();
		$this->_article->save();
	}

	private function setArticleAttributes() {
		$this->_article->setAttributes(array(
			'title' => $this->title,
			'content' => $this->content,
			'parentId' => $this->parentId,
			'shorttitle' => $this->shorttitle,
			'phpFile' => $this->phpFile,
			'articleTextId' => $this->articleTextId,
		));
		$this->_article->access = $this->access;
	}

	public function getArticleModel() {
		return $this->_article;
	}

	public function setAttributes($values, $safeOnly = false) {
		$this->access = array();
		parent::setAttributes($values, $safeOnly);
	}

}
