<?php

class BkTool {

    public function getCompanyOverview($orderBy, $order){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT companyID, id, username, companyName, status, firstName, middleName, lastName, dateUpdated FROM bk_company 
        LEFT JOIN user ON contactorID = id ORDER BY ".$orderBy." ".$order."";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getCompanyOverviewStatistics(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT status, COUNT(DISTINCT companyName) AS sum FROM bk_company GROUP BY status";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduationYears(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT DISTINCT graduationYear FROM user WHERE graduationYear <= now() AND graduationYear > 2006 ORDER BY graduationYear DESC";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getNumberOfGraduatesGroupedByYear(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT graduationYear, COUNT(DISTINCT id) AS sum FROM user 
                WHERE graduationYear <= now() AND graduationYear > 2006 GROUP BY graduationYear ORDER BY graduationYear DESC";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getNumberOfEmployedGraduatesGroupedByYear(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT graduationYear, COUNT(DISTINCT id) AS sum FROM user, bk_company 
                WHERE graduationYear <= now() AND graduationYear > 2006 AND workCompanyID = companyID 
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
        $sql = "SELECT companyID, companyName, COUNT(DISTINCT id) AS sum FROM user, bk_company 
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
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user, bk_company 
                WHERE companyID = workCompanyID AND graduationYear = :graduationYear";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllEmployingCompanies(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT companyID, companyName, COUNT(DISTINCT id) AS sum FROM user, bk_company 
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
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user WHERE graduationYear <= now()";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getSumOfAllEmployedGraduates(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user, bk_company WHERE companyID = workCompanyID";
                    
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllGraduates($orderBy, $order){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT id, firstName, middleName, lastName, graduationYear, username, workDescription, workPlace, companyName, companyID FROM user 
                LEFT JOIN bk_company ON companyID = workCompanyID
                WHERE graduationYear <= now() AND graduationYear > 2006 ORDER BY ".$orderBy." ".$order."";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getGraduatesByYear($year, $orderby, $order){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduationyear' => $year
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.username, un.workDescription, un.workPlace, c.companyName, c.companyID,
                un.imageId, s.name FROM user AS un 
                LEFT JOIN bk_company AS c ON c.companyID = un.workCompanyID 
                LEFT JOIN specialization AS s ON un.specializationId = s.id
                WHERE graduationYear = :graduationyear
                ORDER BY ".$orderby." ".$order."";

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
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user WHERE graduationYear = :graduationyear";

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
        $sql = "SELECT lastLogin FROM user WHERE id = :currentUserID";

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
        $sql = "SELECT DISTINCT id, imageId, firstName, middleName, lastName, username
                FROM bk_company, user 
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
        $sql = "SELECT id, companyID, companyName, status, dateAssigned, dateUpdated FROM user LEFT JOIN bk_company 
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
        $sql = "SELECT companyID, companyName, adress, phoneNumber, homepage, mail, postbox, postnumber, postplace
                FROM bk_company WHERE companyID = :companyId";

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
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.username, s.name, un.graduationYear, 
                un.altEmail, un.imageId, un.workDescription, un.workPlace FROM user AS un
                LEFT JOIN specialization AS s ON un.specializationId = s.id
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
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM user WHERE workCompanyID = :companyId";

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
                WHERE relevantForUserId = :currentUserID AND isDeleted = 'false'";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllUpdatesRelevantForCurrentUser($orderby, $order){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'currentUserID' => Yii::app()->user->id
        );
        $sql = "SELECT un.firstName, un.middleName, un.lastName, cu.dateAdded, c.companyName, cu.description, cu.updateId, cu.companyId, un.id, un.username
                FROM bk_company_update AS cu, user AS un, bk_company AS c
                WHERE cu.relevantForUserId = :currentUserID AND cu.addedById = un.id AND cu.companyId = c.companyID AND isDeleted = 'false'
                ORDER BY ".$orderby." ".$order."";

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
        $sql = "SELECT parent.companyID, parent.companyName FROM bk_company AS parent WHERE parent.companyID = 
                (SELECT subgroupOfID FROM bk_company WHERE companyID = :subCompanyId)";

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
        $sql = "SELECT cs.specializationId, s.name FROM bk_company AS c, specialization AS s, bk_company_specialization AS cs
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
        $sql = "SELECT dateAdded, dateUpdated, dateAssigned FROM bk_company WHERE companyID = :companyId";

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
        $sql = "SELECT status FROM bk_company WHERE companyID = :companyId";

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
        $sql = "SELECT id, username, firstName, middleName, lastName, username FROM bk_company, user
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
        $sql = "SELECT id, firstName, middleName, lastName, username FROM bk_company, user
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
        $sql = "SELECT id, firstName, middleName, lastName, username FROM bk_company, user
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
        $sql = "SELECT COUNT(DISTINCT id) AS sum FROM comment AS cmt, bk_company AS cmp
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
        $sql = "SELECT un.imageId, un.firstName, un.middleName, un.lastName, cmt.timestamp, cmt.content 
                FROM comment AS cmt, bk_company AS cmp, user AS un
                WHERE cmp.companyID = :companyId AND cmt.parentType = 'company'
                AND cmp.companyID = cmt.parentId AND cmt.authorId = un.id
                ORDER BY cmt.timestamp DESC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;     
    }
    
    public function getAllSpecializationNames(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT DISTINCT id, name FROM specialization ORDER BY name";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
    public function getSumOfAllDistinctSpecializationNames(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT COUNT(DISTINCT name) AS sum FROM specialization";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getAllSelectableGraduationYears(){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array();
        $sql = "SELECT DISTINCT graduationYear FROM user
                WHERE graduationYear IS NOT NULL AND graduationYear > 2006 ORDER BY graduationYear DESC";

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
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.username, un.altEmail, s.name, un.imageId,
                c.companyName, un.workDescription, un.workPlace, un.graduationYear FROM user AS un 
                LEFT JOIN bk_company AS c ON un.workCompanyID = c.companyID
                LEFT JOIN specialization AS s ON s.id = un.specializationId
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
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.imageId, un.username, un.lastLogin, un.phoneNumber, mg.comission, mg.start
                FROM user AS un, group_membership AS mg
                WHERE un.id = mg.userId AND mg.groupId = :groupId
                AND DATE(mg.end) = DATE('0000-00-00')
                ORDER BY un.firstname ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
        public function getAllFormerMembersByGroupId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'groupId' => $id
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.imageId, un.username, mg.comission, mg.start, mg.end
                FROM user AS un, group_membership AS mg
                WHERE un.id = mg.userId AND mg.groupId = :groupId
                AND DATE(mg.end) != DATE('0000-00-00')
                ORDER BY mg.end ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
    public function getSumOfAllActiveMembersByGroupId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'groupId' => $id
        );
        $sql = "SELECT COUNT(DISTINCT un.id) AS sum
                FROM user AS un, group_membership AS mg
                WHERE un.id = mg.userId AND mg.groupId = :groupId
                AND DATE(mg.end) = DATE('0000-00-00')";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
    public function getCompanyIdByCompanyName($companyName){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyName' => $companyName
        );
        $sql = "SELECT companyID FROM bk_company WHERE companyName = :companyName";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
    public function getCompanyNameByCompanyId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'companyId' => $id
        );
        $sql = "SELECT companyName FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
   public function getMembershipInfoById($id, $groupId){
        $this->pdo = Yii::app()->db->getPdoInstance();
    
        $data = array(
            'userId' => $id,
            'groupId' => $groupId
        );
        $sql = "SELECT un.id, un.firstName, un.middleName, un.lastName, un.imageId, un.username, mg.comission, mg.start, mg.end
                FROM user AS un, group_membership AS mg
                WHERE un.id = mg.userId AND mg.groupId = :groupId AND un.id = :userId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $data; 
    }
    
    public static function getCompaniesDropDownArray() {
            $companies = app()->db->createCommand()
                            ->select('companyID, companyName')
                            ->from('bk_company')
                            ->order('companyName ASC')
                            ->queryAll();
            $array = array();
            $array[null] = 'Ingen valgt';
            foreach ($companies as $company) {
                    $array[$company['companyID']] = $company['companyName'];
            }
            return $array;
    }
    
    public static function getUsersDropDownArray() {
        $members = app()->db->createCommand()
                        ->select('id, firstName, middleName, lastName')
                        ->from('user')
                        ->where('graduationYear > 2006')
                        ->order('firstName ASC')
                        ->queryAll();
        $array = array();
        $array[null] = 'Ingen valgt';
        foreach ($members as $member) {
                $array[$member['id']] = $member['firstName']." ".$member['middleName']." ".$member['lastName'];
        }
        return $array;
    }
}