<?php

class NewsFeed extends AbstractFeed {

	protected function getActiveRecord($id) {
		return News::model()->with('author')->findByPk($id);
	}

	protected function getMaxElementCount() {
		return News::model()->count();
	}

	protected function getSQL() {
		return "SELECT id FROM `news` 
				ORDER BY `timestamp` DESC";
	}

	protected function getType() {
		return "news";
	}

}