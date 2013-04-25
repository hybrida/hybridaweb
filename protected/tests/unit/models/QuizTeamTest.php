<?php

class QuizTeamTest extends CTestCase {

	public function test_quizTeamScores_oneScore_oneElementInResult() {
		$team = Util::getQuizTeam();
		$event = Util::getQuizEvent($team->id);
		$score = Util::getQuizTeamScore($event->id, $team->id);

		$team2 = QuizTeam::model()->findByPk($team->id);
		$score2 = $team2->quizTeamScores;
		$this->assertEquals(1, count($score2));
	}

}