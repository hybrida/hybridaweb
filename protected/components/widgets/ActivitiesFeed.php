<?php

class ActivitiesFeed extends CWidget {

	public $limit = 5;

	public function run() {
			$this->runFeed();
	}

	public function runFeed() {
		$feed = new SignupFeed($this->limit);
		$elements = $feed->getElements();
		$this->render('activitiesFeed', array(
			'models' => $elements,
		));
	}

}

class SignupFeed extends AbstractFeed {

	protected function getActiveRecord($id) {
		$model =  News::model()->findByPk($id);
		$parent = Event::model()->findByPk($model->parentId);
		$model['event'] = $parent;
		return $model;
	}

	protected function getMaxElementCount() {
		return Signup::model()->count();

	}

	protected function getSQL() {
		return "SELECT n.id
			FROM news as n
			JOIN event as e ON n.parentId = e.id
			WHERE e.start > NOW()
				AND e.status = " . Status::PUBLISHED ."
				AND n.status = " . Status::PUBLISHED ."
			ORDER BY e.start ASC";
	}

	protected function getType() {
		return "news";
	}

}
