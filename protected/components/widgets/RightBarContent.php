<?php

class RightBarContent extends CWidget {

	private $selfId;
	private $rImagePath = "images/unknown_malefemale_profile.jpg";
	private $data;

	public function init() {
		if (!Yii::app()->user->isGuest) {
			$this->addActivities();
		}
	}

	public function run() {
        
		if (Yii::app()->user->isGuest) {
			$this->render("rightBarContent/guest");
		} else {
            
            if(!isset($this->data['imageId'])){
                $this->data['imageId'] = $this->getImageId();
            }
			$this->render("rightBarContent/user",  $this->data);
		}
	}
    //Ved å bruke en setfunksjon kan vi friere angi hvilket bilde som vises. 
    //F.eks i ProfileController/EventController/ArticleController
    public function setImageId($id){
        $this->data['imageId'] = $id;
    }
    
	private function getImageId() {
		$userId = Yii::app()->user->id;
		//Setter profilbildet
		$query = "SELECT imageId FROM user_new WHERE id =?";
		$command = Yii::app()->db->createCommand($query);
		$query = $command->query(array($userId));
		$data = $query->read();
		$this->data['imageId'] = $data['imageId'];
	}

	public function addActivities() {
		$sql = "SELECT firstName, middleName, lastName FROM user_new WHERE id = ?";
		$command = Yii::app()->db->createCommand($sql);
		$query = $command->query(array(Yii::app()->user->id));
		$this->data = $query->read();
	}

}