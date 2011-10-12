<?php

class RightBarContent extends CWidget {

	private $selfId;
	private $rImagePath = "images/unknown_malefemale_profile.jpg";
	private $data;

	public function init() {
		if (!Yii::app()->user->isGuest) {
			$this->addActivities();
			$this->getImageId();
		}
	}

	public function run() {
		if (Yii::app()->user->isGuest) {
			$this->render("rbc/guest");
		} else {
			$this->render("rbc/user",  $this->data);
		}
	}

	private function getImageId() {
		$userId = Yii::app()->user->id;
		//Setter profilbildet
		$query = "SELECT imageId FROM user_info WHERE userId =?";
		$command = Yii::app()->db->createCommand($query);
		$query = $command->query(array($userId));
		$data = $query->read();
		$this->data['imageId'] = $data['imageId'];
	}

	public function addActivities() {
		$sql = "SELECT firstName, middleName, lastName FROM user_info WHERE userId = ?";
		$command = Yii::app()->db->createCommand($sql);
		$query = $command->query(array(Yii::app()->user->id));
		$this->data = $query->read();
	}

}