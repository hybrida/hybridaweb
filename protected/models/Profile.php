<?php

class Profile {
    protected $pdo;
    
    public function info($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'id' => $id
        );
        
        $sql = "SELECT un.firstName, un.middleName, un.lastName, un.username, un.phoneNumber, un.specialization, un.graduationYear, un.imageId, un.member FROM user_new un WHERE u.id = :id";
		$query = $this->pdo->prepare($sql);
        $query->execute($data);
        
        return $query->fetch(PDO::FETCH_ASSOC);
        
    }
    
    public function displayMembers($year){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
		$data = array(
            'year' => $year
        );
        
        $sql = "SELECT ui.userId, ui.firstName, ui.middleName, ui.lastName, ui.imageId
                FROM user_info AS ui WHERE graduationYear = :year";
		$query = $this->pdo->prepare($sql);
        $query->execute($data);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
		return $result;
        
	}
}
?>
