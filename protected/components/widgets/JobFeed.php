<?php

class JobFeed extends CWidget {
	
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
		return Job::model()->findByPk($id);
	}

	protected function getMaxElementCount() {
		return Job::model()->count();
		
	}

	protected function getSQL() {
		return "SELECT id
			FROM job 
			WHERE start > NOW()
			ORDER BY RAND()";
	}

	protected function getType() {
		return "job";
	}

}