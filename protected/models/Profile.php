<?php

class Profile {
    protected $pdo;
    
    public function info($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'id' => $id
        );
        
        $sql = "SELECT un.firstName, un.middleName, un.lastName, un.username, un.phoneNumber, un.specializationId, 
                un.graduationYear, un.imageId, un.member, un.gender, un.cardinfo, un.birthdate, un.altEmail, un.description,
                siteId, name FROM hyb_user AS un LEFT JOIN hyb_specialization ON specializationId = hyb_specialization.id WHERE un.id = :id";
	
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        
        return $query->fetch(PDO::FETCH_ASSOC);
        
    }
    
    public function displayMembers($year){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'year' => $year
        );
        
        $sql = "SELECT ui.id, ui.firstName, ui.middleName, ui.lastName, ui.imageId, ui.member, siteId, name
                FROM hyb_user AS ui LEFT JOIN hyb_specialization ON specializationId = hyb_specialization.id WHERE graduationYear = :year";
	
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
		return $result;
        
	}
}