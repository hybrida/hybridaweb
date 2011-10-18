<?php

class Profile {
    
    
    public function info($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'id' => $id
        );
        
        $sql = "SELECT ui.firstName, ui.middleName, ui.lastName, u.username, ui.phoneNumber, ui.specialization, ui.graduationYear, ui.imageId, ui.member FROM user u, user_new ui WHERE ui.id=u.id AND u.id=:id";
		$query = $this->pdo->prepare($sql);
        $query->execute($data);
        
        return $query->fetch(PDO::FETCH_ASSOC);
        
    }
}
?>
