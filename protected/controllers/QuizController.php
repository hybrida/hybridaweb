<?php

class QuizController extends Controller {
	
	// Oversikt over alle lag med poengsum
	public function actionIndex() {
		$teams = QuizTeam::model()->with('quizTeamScores')->findAll();
		$teamScoreValues = array();
		
		foreach ($teams as $team) {
			$totalScore = 0;
			$teamScores = $team->quizTeamScores;
			foreach ($teamScores as $scoreObject) {
				$totalScore += $scoreObject->score;
			}
			$teamScoreValues[$team->id] = $totalScore;
		}
		
		$this->render("status", array(
			'quizTeams' => $teams,
			'totalScore' => $teamScoreValues,
		));
	}
	
	private function getTeamScore($team) {
		
	}
}
