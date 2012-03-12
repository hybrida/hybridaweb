<?php

class UserOptions extends CWidget {
    
    public function init() {
		/*if (!Yii::app()->user->isGuest) {
			$this->addActivities();
		}*/
	}

	public function run() {
        if (Yii::app()->user->isGuest) {
			$this->render("userOptionsWidget/guest");
        }else{
            
            $sql = "SELECT firstName, middleName, lastName FROM user WHERE id = ?";
            $command = Yii::app()->db->createCommand($sql);
            $query = $command->query(array(Yii::app()->user->id));
            $data = $query->read();

			$this->render("userOptionsWidget/user",  $data);
		}
	}

}