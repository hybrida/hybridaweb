<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleTreeTest
 *
 * @author krisvage
 */
class ArticleTreeTest extends CTestCase {
	public function test_article_tree() {
		$widget = $this->widget('application.components.widgets.ArticleTree');
		$articleTree = $widget->articleTree;
		print_r($articleTree);
	}
	
}

?>
