<?php

class ApiController extends Controller {

	public function actionAddGossip() {
		$newGossip = $_POST['gossipText'];
		$gossip = new Gossip;

		$gossip->gossipText = $newGossip;
		$gossip->save();
	}

	public function actionShowGossip() {
		$gossips = Gossip::model()->findAll();

		$this->render("gossip", array(
			'gossipText' => $gossips,
		));
	}
}
