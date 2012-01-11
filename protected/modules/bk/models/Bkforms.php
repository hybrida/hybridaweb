<?php

class Bkforms {
    
    public function addCompanyComment($comment, $id){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'comment' => $comment,
            'companyId' => $id,
            'currentUserId' => Yii::app()->user->id
        );
        $sql = "INSERT INTO comment (parentId, parentType, content, author, timestamp) 
		VALUES (:companyId, 'company', :comment, :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyCommentUpdate($id, $relevantUserId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $id,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'En kommentar er lagt til om bedriften', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function deleteAllUpdatesRelevantToCurrentUser(){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'currentUserId' => Yii::app()->user->id
        );
        $sql = "DELETE FROM bk_company_update WHERE relevantForUserId = :currentUserId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function deleteUpdateByUpdateId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'updateId' => $id
        );
        $sql = "DELETE FROM bk_company_update WHERE updateId = :updateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function isCompanyInDatabase($companyName){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array();
        $sql = "SELECT companyName FROM bk_company ORDER BY companyName";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['companyName'] == $companyName){
                return true;
            }
        endforeach;
    }
    
    public function isInputFieldEmpty($inputvariable){
        return ($inputvariable == '' ? true : false);
    }
    
    public function updateGraduateAltEmail($id, $altEmail){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'altEmail' => $altEmail
        );
        $sql = "UPDATE user_new SET altEmail = :altEmail WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateSpecialization($id, $specializationId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'specializationId' => $specializationId
        );
        $sql = "UPDATE user_new SET specialization = :specializationId WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateWorkDescription($id, $workDescription){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'workDescription' => $workDescription
        );
        $sql = "UPDATE user_new SET workDescription = :workDescription WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateWorkPlace($id, $workPlace){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'workPlace' => $workPlace
        );
        $sql = "UPDATE user_new SET workPlace = :workPlace WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateGraduationYear($id, $graduationYear){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'graduationYear' => $graduationYear
        );
        $sql = "UPDATE user_new SET graduationYear = :graduationYear WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function hasGraduateWorkCompanyChanged($id, $companyName){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id
        );
        $sql = "SELECT companyName FROM bk_company, user_new 
                WHERE id = :graduateId AND workCompanyID = companyID";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['companyName'] != $companyName){
                return true;
            }
        endforeach;
    }
    
    public function updateGraduateWorkCompany($id, $companyName){
        $data = array(
            'graduateId' => $id,
            'companyName' => $companyName
        );
        $sql = "UPDATE user_new SET workCompanyID = companyID WHERE id = :graduateId AND companyName = :companyName";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyGraduateUpdate($relevantUserId, $companyName){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyName' => $companyName,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, companyID, 'En alumnistudent er knyttet til om bedriften', :currentUserId, now())
                FROM bk_company WHERE companyName = :companyName";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
}
