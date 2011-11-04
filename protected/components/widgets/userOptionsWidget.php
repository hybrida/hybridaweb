<?php

class UserOptionsWidget extends CWidget {
    
    public function init() {
		/*if (!Yii::app()->user->isGuest) {
			$this->addActivities();
		}*/
	}

	public function run() {
        if (Yii::app()->user->isGuest) {
			$this->render("UserOptionsWidget/guest");
        }else{
            
            $sql = "SELECT firstName, middleName, lastName FROM user_new WHERE id = ?";
            $command = Yii::app()->db->createCommand($sql);
            $query = $command->query(array(Yii::app()->user->id));
            $data = $query->read();

			$this->render("UserOptionsWidget/user",  $data);
		}
	}
}
?>
