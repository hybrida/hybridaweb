<?php

class JobAnnouncementFeed extends CWidget {
	
	public $limit = 5;

	public function run() {
			$this->runFeed();
	}
	
	public function runFeed() {
		$feed = new JobFeedFinder($this->limit);
		$elements = $feed->getElements();
		$this->render('jobFeed', array(
			'models' => $elements,
		));
	}

}

class JobFeedFinder extends AbstractFeed {

	protected function getActiveRecord($id) {
		return JobAnnouncement::model()->findByPk($id);
	}

	protected function getMaxElementCount() {
		return JobAnnouncement::model()->count();
		
	}

	protected function getSQL() {
		return "SELECT id
			FROM job_announcement 
			WHERE start > NOW()
			ORDER BY RAND()";
	}

	protected function getType() {
		return "job_announcement";
	}

}