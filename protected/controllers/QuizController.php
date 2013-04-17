<?php

class QuizController extends Controller {
	
	// Oversikt over alle lag med poengsum
	public function actionIndex() {
		$teams = QuizTeam::model()->findAll();
		
		foreach ($teams as $team) {
			debug($team);
			echo '<br>';
			
			
			$totalScore = 0;
			$teamScores = $team->quizTeamScores;
			debug($teamScores);
			foreach ($teamScores as $scoreObject) {
				die();
				$totalScore += $scoreObject->score;
			}
			echo $totalScore;
		}
		
		return;
		$this->render("status", array(
			'quizTeams' => $teams,
		));
	}
	
	private function getTeamScore($team) {
		
	}
}
