<?php

class ArticleForm extends CFormModel {

	private $_article;
	public $access = array();
	public $author;
	public $content;
	public $parentId;
	public $shorttitle;
	public $title;
	public $phpFile;
	public $weight;

	public function __construct(Article $article, $scenario = '') {
		parent::__construct($scenario);

		if ($article == null) {
			throw new NullPointerException("articleinput was null");
		}

		$this->_article = $article;
		$this->initAttributes();
	}

	private function initAttributes() {
		$this->title = $this->_article->title;
		$this->content = $this->_article->content;
		$this->parentId = $this->_article->parentId;
		$this->shorttitle = $this->_article->shorttitle;
		$this->access = $this->_article->access;
		$this->phpFile = $this->_article->phpFile;
		$this->weight = $this->_article->weight;
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
			'weight' => $this->weight,
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
