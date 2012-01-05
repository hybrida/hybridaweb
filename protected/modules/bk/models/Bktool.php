<?php

class BkTool {
        
    public function getCompanyOverview(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT companyID, id, companyName, status, firstName, middleName, lastName, dateAdded FROM company 
        LEFT JOIN user_new ON contactorID = id";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getCompanyOverviewStatistics(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT status, COUNT(DISTINCT companyName) AS sum FROM company GROUP BY status";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduationYears(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT DISTINCT graduationYear FROM user_new WHERE graduationYear <= now() ORDER BY graduationYear DESC";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduationYearStudents(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT graduationYear, COUNT(DISTINCT id) AS sum FROM user_new 
                WHERE graduationYear <= now() GROUP BY graduationYear ORDER BY graduationYear DESC";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getAllEmployedGraduationYearStudents(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT graduationYear, COUNT(DISTINCT id) AS sum FROM user_new, company 
                WHERE graduationYear <= now() AND workCompanyID = companyID 
                GROUP BY graduationYear ORDER BY graduationYear DESC";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;          
    }
    
    public function getGraduationCompaniesByYear($year){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduationYear' => $year
        );
        $sql = "SELECT companyID, companyName, COUNT(DISTINCT id) AS sum FROM user_new, company 
                WHERE companyID = workCompanyID AND graduationYear = :graduationYear GROUP BY companyName
                ORDER BY sum DESC, companyName ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;    
    }
    
    public function getGraduationCompaniesByYearSum($year){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduationYear' => $year
        );
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new, company 
                WHERE companyID = workCompanyID AND graduationYear = :graduationYear";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduationCompanies(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT companyID, companyName, COUNT(DISTINCT id) AS sum FROM user_new, company 
                WHERE companyID = workCompanyID GROUP BY companyName
                ORDER BY sum DESC, companyName ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduationYearsSum(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new WHERE graduationYear <= now()";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduationCompaniesSum(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new, company WHERE companyID = workCompanyID";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduates(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT id, firstName, middleName, lastName, graduationYear, workDescription, workPlace, companyName, companyID FROM user_new 
                LEFT JOIN company ON companyID = workCompanyID
                WHERE graduationYear <= now()";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getLastLoginCurrentUser(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'userID' => Yii::app()->user->id
        );
        $sql = "SELECT lastLogin FROM user_new WHERE id = :userID";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getContactingMembersByStatus($status){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'status' => $status
        );
        $sql = "SELECT DISTINCT user_new.id, firstName, middleName, lastName, image.id AS imageId
                FROM company, user_new LEFT JOIN image ON userId = user_new.id 
                WHERE contactorID = user_new.id AND status = :status ORDER BY firstName ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getMemberCompaniesByStatus($status){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'status' => $status
        );
        $sql = "SELECT id, companyID, companyName, status, dateAssigned, dateUpdated FROM user_new LEFT JOIN company 
                ON id = contactorID WHERE status = :status ORDER BY firstName ASC, companyName ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;    
    }
}
