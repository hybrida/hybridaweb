<?php

class ActivitiesFeed extends CWidget {

	public function run() {
		if (!user()->isGuest)
			$this->render('activitiesFeed');
	}

}