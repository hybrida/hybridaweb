<?php

/**
 * Widget for å håndtere de statiske artiklene på siden.
 * Lager et statisk tre av artiklene i databasen og vil i
 * run-metoden skrive ut alle som skal skrives ut i forhold
 * til hvor i treet brukeren er.
 */
class ArticleTree extends CWidget {

	public $currentId;
	private static $articleTree;

	public static function getArticleTree() {
		if (!isset(self::$articleTree)) {
			self::setArticleTree();
		}
		return self::$articleTree;
	}

	public function init() {
		self::setArticleTree();
	}

	private static function setArticleTree() {
		$articles = Article::model()->findAll();
		self::$articleTree = self::treeBuilder($articles);
		Node::sortNodes(self::$articleTree);
	}

	private static function treeBuilder($articles, $parentId = null) {
		if (empty($articles)) {
			return array();
		}

		$branchOfArticleTree = array();
		foreach ($articles as $article) {
			if (($article->parentId == null && $parentId == null)
					|| $article->parentId == $parentId) {

				$key = array_search($article, $articles);
				unset($articles[$key]);

				if (app()->gatekeeper->hasPostAccess('article', $article->id)) {
					$branchOfArticleTree[] = new Node(
									$article->id,
									$article->parentId,
									$article->title,
									$article->shorttitle,
									$article->weight,
									self::treeBuilder($articles, $article->id)
					);
				}
			}
		}
		return $branchOfArticleTree;
	}

	public function run() {
		$currentArticles = $this->findRelevantArticles($this->articleTree, $this->currentId);
		$this->printArticleTree($currentArticles[1]);
	}

	private function findRelevantArticles($subTree, $id) {
		if (empty($subTree))
			return array();
		foreach ($subTree as $node) {
			if ($node->id == $id) {
				return array(null, array($node->children, array()));
			}
			$found = $this->findRelevantArticles($node->children, $id);
			if (!empty($found)) {
				return array(null, array($node->children, $found));
			}
		}
	}

	private function printArticleTree($relevantArticles) {
		if (empty($relevantArticles))
			return;

		echo "\n<div class='g-sidebarNav'><ul class=\"widget-articletree g-sidebarNav\">\n";
		foreach ($relevantArticles[0] as $node) {
						if (!empty($node->children))
							echo "<li class = \"hasChildren\">";
						else
							echo "<li class = \"childless\">";

			$this->printNode($node);
			if ($this->containsChild($node, $relevantArticles[1])) {
				foreach ($relevantArticles[1] as $children) {
					$this->printArticleTree($children);
				}
			}
			echo "</li>\n";
		}
		echo "</ul>\n</div>";
	}

	private function printNode($node) {
		$title = $node->title;
		if (isset($node->shorttitle))
			$title = $node->shorttitle;

		if ($this->currentId != $node->id) {
					echo CHtml::link($title, array(
				'/article/view',
				'id' => $node->id,
				'title' => $node->title,
			));
		} else {
			echo "<span class=\"current\">$title</span>";
		}
	}

	private function containsChild($parent, $possibleChildren) {
		if (isset($possibleChildren[1]) && isset($possibleChildren[1][0])) {
			foreach ($possibleChildren[1][0] as $child) {
				if ($parent->id == $child->parentId)
						return true;
			}
		}
		return false;
	}
}

class Node {
	public $id;
	public $parentId;
	public $title;
	public $shorttitle;
	public $children = array();
	public $weight;

	public function __construct($id, $parentId, $title, $shorttitle, $weight, $children) {
		$this->id = $id;
		$this->parentId = $parentId;
		$this->title = $title;
		$this->shorttitle = $shorttitle;
		$this->setChildren($children);
		$this->weight = $weight;
	}

	public static function sortNodes(&$nodes) {
		usort($nodes, array(__CLASS__, "compare"));
	}

	private function setChildren($children) {
		$this->children = $children;
		self::sortNodes($this->children);
	}

	private static  function compare($a, $b) {
		if ($a->weight == $b->weight)
			return strcmp($a->title, $b->title);
		return $b->weight - $a->weight;
	}
}
