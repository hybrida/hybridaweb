<?php

class QuizController extends Controller {
	
	public function actionIndex() {
		$teams = QuizTeam::getQuizTeams();
		$this->render("status", array(
			'quizTeams' => $teams,
		));
	}
}