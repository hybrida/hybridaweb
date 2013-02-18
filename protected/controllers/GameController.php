<?php

class GameController extends Controller {
	
	public function actionGriff() {
		$highscorelist = GriffgameHighscore::getTopScores();
		$this->render('griff', array(
			'highscorelist' => $highscorelist,
		));
	}

	public function actionScore() {
		if (user()->isGuest) {
			echo "Du må være logget inn for å få navnet ditt på highscorelista";
			return;
		} 
		$hs = new GriffgameHighscore();
		$hs->score = ((double)$_GET['time']) * 100;
		$hs->userId = user()->id;
		$hs->timestamp = new CDbExpression("NOW()");
		$okSave = $hs->save();
		echo CJSON::encode(GriffgameHighscore::getTopScores());
	}

}