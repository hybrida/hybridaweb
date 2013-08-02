<?php

Yii::import('application.components.widgets.ArticleTree');

class ArticleTreeTest extends CTestCase {
	public function test_article_tree() {
		$widget = new ArticleTree();
		$articleTree = $widget->articleTree;
		//print_r($articleTree);
	}

}