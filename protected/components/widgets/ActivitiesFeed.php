<?php

class ActivitiesFeed extends CWidget {
	
	public $limit = 5;

	public function run() {
		if (!user()->isGuest){
			$this->runFeed();
		}
		
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
		return News::model()->findByPk($id);
	}

	protected function getMaxElementCount() {
		return Signup::model()->count();
		
	}

	protected function getSQL() {
		return "SELECT n.id
			FROM news as n
			JOIN event as e ON n.parentId = e.id
			JOIN membership_signup AS m ON m.eventId = e.id
			WHERE m.userId = " . user()->id ."
				AND e.start > NOW()
			ORDER BY n.timestamp ASC";
	}

	protected function getType() {
		return "news";
	}

}
