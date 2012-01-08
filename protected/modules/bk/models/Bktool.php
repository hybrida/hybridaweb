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
    
    public function getNumberOfGraduatesGroupedByYear(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT graduationYear, COUNT(DISTINCT id) AS sum FROM user_new 
                WHERE graduationYear <= now() GROUP BY graduationYear ORDER BY graduationYear DESC";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getNumberOfEmployedGraduatesGroupedByYear(){
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
    
    public function getEmployingCompaniesByYear($year){
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
    
    public function getSumOfEmployedGraduatesByYear($year){
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
    
    public function getAllEmployingCompanies(){
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
    
    public function getSumOfAllGraduates(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new WHERE graduationYear <= now()";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getSumOfAllEmployedGraduates(){
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
    
    public function getGraduatesByYear($year){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduationyear' => $year
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.workDescription, un.workPlace, c.companyName, c.companyID,
                un.imageId, s.name FROM user_new AS un 
                LEFT JOIN company AS c ON c.companyID = un.workCompanyID 
                LEFT JOIN spesialization AS s ON un.specialization = s.id
                WHERE graduationYear = :graduationyear";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getSumOfGraduatesByYear($year){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduationyear' => $year
        );
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new WHERE graduationYear = :graduationyear";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;         
    }
    
    public function getLastLoginCurrentUser(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'currentUserID' => Yii::app()->user->id
        );
        $sql = "SELECT lastLogin FROM user_new WHERE id = :currentUserID";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getMembersByContactingStatus($status){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'status' => $status
        );
        $sql = "SELECT DISTINCT id, imageId, firstName, middleName, lastName
                FROM company, user_new 
                WHERE contactorID = id AND status = :status ORDER BY firstName ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getCompaniesByContactingStatus($status){
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
    
    public function getCompanyContactInfoById($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT companyName, adress, phoneNumber, homepage, mail, postbox, postnumber, postplace
                FROM company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getEmployedGraduatesByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, s.name, un.graduationYear FROM user_new AS un
                LEFT JOIN spesialization AS s ON un.specialization = s.id
                WHERE un.workCompanyID = :companyId ORDER BY un.graduationYear DESC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getSumOfEmployedGraduatesByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user_new WHERE workCompanyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getLatestUpdateTimeStampRelevantForCurrentUser(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'currentUserID' => Yii::app()->user->id
        );
        $sql = "SELECT MAX(dateAdded) AS latesttimestamp FROM bk_company_update
                WHERE relevantForUserId = :currentUserID";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getSumOfUpdatesRelevantForCurrentUser(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'currentUserID' => Yii::app()->user->id
        );
        $sql = "SELECT COUNT(DISTINCT updateId) AS sum FROM bk_company_update
                WHERE relevantForUserId = :currentUserID";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllUpdatesRelevantForCurrentUser(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'currentUserID' => Yii::app()->user->id
        );
        $sql = "SELECT un.firstName, un.middleName, un.lastName, cu.dateAdded, c.companyName, cu.description, cu.updateId, cu.companyId, un.id
                FROM bk_company_update AS cu, user_new AS un, company AS c
                WHERE cu.relevantForUserId = :currentUserID AND cu.addedById = un.id AND cu.companyId = c.companyID";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getParentCompanyBySubCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'subCompanyId' => $id
        );
        $sql = "SELECT companyID, companyName FROM company WHERE companyID = 
                (SELECT subgroupOfID FROM company WHERE companyID = :subCompanyId)";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;       
    }
    
    public function getRelevantSpecializationsByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT s.name FROM company AS c, spesialization AS s, bk_company_specialization AS cs
                WHERE c.companyID = cs.companyId AND c.companyID = :companyId
                AND cs.specializationId = s.id ORDER BY name ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;    
    }
    
    public function getAllCompanyTimestampsByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT dateAdded, dateUpdated, dateAssigned FROM company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;    
    }
    
    public function getStatusByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT status FROM company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;        
    }
    
    public function getContactorByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT id, firstName, middleName, lastName FROM company, user_new
                WHERE companyID = :companyId AND contactorID = id";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getPersonWhichUpdatedLastByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT id, firstName, middleName, lastName FROM company, user_new
                WHERE companyID = :companyId AND updatedByID = id";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getPersonWhichAddedCompanyByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT id, firstName, middleName, lastName FROM company, user_new
                WHERE companyID = :companyId AND addedByID = id";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getSumOfAllCommentsByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM comment AS cmt, company AS cmp
                WHERE cmp.companyID = :companyId AND cmt.parentType = 'company'
                AND cmp.companyID = cmt.parentId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;    
    }
    
    public function getAllCommentsByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT un.firstName, un.middleName, un.lastName, cmt.timestamp, cmt.content 
                FROM comment AS cmt, company AS cmp, user_new AS un
                WHERE cmp.companyID = :companyId AND cmt.parentType = 'company'
                AND cmp.companyID = cmt.parentId AND cmt.author = un.id";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getAllSpecializationNames(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT DISTINCT name FROM Spesialization ORDER BY name";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
    public function getSumOfAllDistinctSpecializationNames(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT COUNT(DISTINCT name) AS sum FROM Spesialization";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllSelectableGraduationYears(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT DISTINCT graduationYear FROM user_new
                WHERE graduationYear <= DATE(NOW()) ORDER BY graduationYear DESC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;   
    }
    
    public function getGraduateInfoByUserId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'userId' => $id
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.altEmail, s.name, un.imageId,
                c.companyName, un.workDescription, un.workPlace, un.graduationYear FROM user_new AS un 
                LEFT JOIN company AS c ON un.workCompanyID = c.companyID
                LEFT JOIN Spesialization AS s ON s.id = un.specialization
                WHERE un.id = :userId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;   
    }
    
    public function getAllActiveMembersByGroupId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'groupId' => $id
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.altEmail, s.name, un.imageId,
                c.companyName, un.workDescription, un.workPlace, un.graduationYear FROM user_new AS un 
                LEFT JOIN company AS c ON un.workCompanyID = c.companyID
                LEFT JOIN Spesialization AS s ON s.id = un.specialization
                WHERE un.id = :userId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
}
