<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleTree
 *
 * @author krisvage
 */
class ArticleTree extends CWidget {

	public $currentId;
	private $articleTree;

	public function init() {
		$this->articleTree = self::getArticleTree();
	}

	public static function getArticleTree() {
		$articles = Article::model()->findAll();
		$articleTree = self::topOfTreeBuilder($articles);
		return $articleTree;
	}

	private static function topOfTreeBuilder($articles) {
		$articleTree = array();
		$i = 0;
		foreach ($articles as $article) {
			if ($article->parentId == null) {
				$key = array_search($article, $articles);
				unset($articles[$key]);
				$articleTree[$i] = new Node(
								$article->id,
								$article->title,
								self::recursiveTreeBuilder($articles, $article->id)
				);
				$i++;
			}
		}
		return $articleTree;
	}

	private static function recursiveTreeBuilder($articles, $parentId) {
		if (empty($articles)) {
			return array();
		}

		$articleNodeArray = array();
		$i = 0;
		foreach ($articles as $article) {
			if ($article->parentId == $parentId) {
				$key = array_search($article, $articles);
				unset($articles[$key]);
				$articleNodeArray[$i] = new Node(
								$article->id,
								$article->title,
								self::recursiveTreeBuilder($articles, $article->id)
				);
				$i++;
			}
		}
		return $articleNodeArray;
	}

	public function run() {
		$root = $this->findArticleRoot();
		echo "<ul>";
		$this->printTree($root);
		echo "</ul>";
	}

	private function findArticleRoot() {
		foreach ($this->articleTree as $root) {
			if ($this->isIdInTree($this->currentId, $root)) {
				return $root;
			}
		}
		return new Node(null, null, null);
	}

	private function isIdInTree($id, $node) {
		$found = false;
		if ($id == $node->id) {
			return true;
		}
		foreach ($node->children as $child) {
			$found = $this->isIdInTree($id, $child);
			if ($found) {
				break;
			}
		}
		return $found;
	}

	private function printTree($node) {
		$this->printNode($node);
		if (empty($node->children)) {
			return;
		}
		echo "<ul>";

		foreach ($node->children as $child) {
			$this->printTree($child);
		}
		echo "</ul>";
	}

	private function printNode($node) {
		echo "<li>";
		echo CHtml::link($node->title, array(
			'/article/view',
			'id' => $node->id,
			'title' => $node->title,
		));
		echo "</li>";
	}

}

class Node {

	public $id;
	public $title;
	public $children = array();

	public function __construct($id, $title, $children) {
		$this->id = $id;
		$this->title = $title;
		$this->children = $children;
	}

}