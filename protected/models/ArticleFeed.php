<?php

class ArticleFeed extends AbstractFeed {
	protected function getActiveRecord($id) {
		return Article::model()->findByPk($id);
	}

	protected function getMaxElementCount() {
		return Article::model()->count();
	}

	protected function getSQL() {
		return "SELECT id FROM `article` 
				ORDER BY `timestamp` DESC";
	}

	protected function getType() {
		return "article";
	}

}