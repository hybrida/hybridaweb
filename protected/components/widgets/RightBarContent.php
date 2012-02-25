<?php

class RightBarContent extends CWidget {

	private $selfId;
	private $rImagePath = "images/unknown_malefemale_profile.jpg";
	private $data;
    public $imageId;
    private $pdo;

	public function init() {
        $this->pdo = Yii::app()->db->getPdoInstance();
        
		if (!Yii::app()->user->isGuest) {
			$this->addActivities();
		}
        $this->data['imageId'] = -1;
	}

	public function run() {
        
		if (Yii::app()->user->isGuest) {
			$this->render("rightBarContent/guest");
		} else {
            
            if(isset($this->imageId)) {
                $this->data['imageId'] = $this->imageId;
            }
            else{
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
		$sql = "SELECT imageId FROM hyb_user WHERE id = :userId";
		$query = $this->pdo->prepare($sql);
		$query->execute( array('userId' => $userId ) );
        
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['imageId'];
	}

	public function addActivities() {
        
        $sql = "SELECT firstName, middleName, lastName FROM hyb_user WHERE id = ?";
		$command = Yii::app()->db->createCommand($sql);
		$query = $command->query(array(Yii::app()->user->id));
		$this->data = $query->read();
        
		$sql = "SELECT e.id, e.title, e.start FROM 
                event AS e RIGHT JOIN signup_membership AS ms 
                ON ms.eventId= e.id 
                WHERE ms.userId = :userId AND start > NOW()
                ORDER BY start DESC ";
		$query = $this->pdo->prepare($sql);
		$query->execute(array('userId' => Yii::app()->user->id));
		
        $this->data['activities'] = $query->fetchAll(PDO::FETCH_ASSOC);
	}

}