<?php

class QuizController extends Controller {
	
	public function actionIndex() {
		$teams = QuizTeam::model()->findAll();

		$this->render("status", array(
			'quizTeams' => $teams,
		));
	}
}