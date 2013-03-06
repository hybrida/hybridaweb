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
				WHERE `status` = " . Status::PUBLISHED . "
				ORDER BY `weight` DESC, `timestamp` DESC";
	}

	protected function getType() {
		return "news";
	}

}