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
        $this->pdo = Yii::app()->db->getPdoInstance();
        
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
    
    public function insertCompanyInformation($companyName, $mail, $phonenumber, $adress, $postbox, $postnumber, $postplace, $homepage, $parentCompanyId, $status){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyName' => $companyName,
            'mail' => $mail,
            'phonenumber' => $phonenumber,
            'adress' => $adress,
            'postbox' => $postbox,
            'postnumber' => $postnumber,
            'postplace' => $postplace,
            'homepage' => $homepage,
            'parentCompanyId' => $parentCompanyId,
            'status' => $status,
            'addedById' => Yii::app()->user->id
        );
        $sql = "INSERT INTO bk_company (companyName, mail, phonenumber, adress, postbox, postnumber, postplace, homepage, subgroupOfID, status, addedByID, dateAdded) 
		VALUES (:companyName, :mail, :phonenumber, :adress, :postbox, :postnumber, :postplace, :homepage, :parentCompanyId, :status, :addedById, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateCompanyContactor($companyId, $contactorId){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'companyId' => $companyId,
            'contactorId' => $contactorId
        );
        $sql = "UPDATE bk_company SET contactorID = :contactorId, dateAssigned = now() WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function insertCompanySpecialization($companyId, $specializationId){
                $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'specializationId' => $specializationId
        );
        $sql = "INSERT INTO bk_company_specialization (companyId, specializationId) 
		VALUES (:companyId, :specializationId)";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyInsertionUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriften har blitt lagt til', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyStatusUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens status har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyMailUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens mailadresse har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyPhonenumberUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens telefonnummer har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyAdressUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens adresse har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyPostboxUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens postboks har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyPostnumberUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens postnummer har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyPostplaceUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens poststed har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyHomepageUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens hjemmeside har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }

    public function addCompanyParentCompanyUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens har blitt satt som en undergruppe', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyContactorUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'En bedriftskontakt har blitt tildelt bedriften', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanySpecializationUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'En spesialisering har blitt knyttet til bedriften', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateCompanyInformation($companyId, $companyName, $mail, $phonenumber, $adress, $postbox, $postnumber, $postplace, $homepage, $parentCompanyId, $status){
                $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'companyName' => $companyName,
            'mail' => $mail,
            'phonenumber' => $phonenumber,
            'adress' => $adress,
            'postbox' => $postbox,
            'postnumber' => $postnumber,
            'postplace' => $postplace,
            'homepage' => $homepage,
            'parentCompanyId' => $parentCompanyId,
            'status' => $status,
            'updatedById' => Yii::app()->user->id
        );
        $sql = "UPDATE bk_company SET companyName = :companyName, mail = :mail, phoneNumber = :phonenumber, adress = :adress, postbox = :postbox
                postnumber = :postnumber, postplace = :postplace, homepage = :homepage, subgroupOfID = :parentCompanyId, status = :status,
                updatedByID = :updatedById, dateUpdated = now() WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function hasCompanyContactorChanged($companyId, $contactorId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT contactorID FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['contactorID'] != $contactorId){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanySpecializationsChanged($companyId, $specializations){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT specializationId FROM bk_company_update WHERE companyId = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $bool = true;
        
        foreach ($data as $company) :
            foreach ($specializations as $specialization) :
                if($company['specializationId'] == $specialization){
                    $bool = false;
                    break;
                }
            endforeach;
        endforeach;
        
        return $bool;
    }
    
    public function hasCompanyNameChanged($companyId, $companyName){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT contactorName FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['contactorName'] != $companyName){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyMailChanged($companyId, $mail){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT mail FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['mail'] != $mail){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyPhoneNumberChanged($companyId, $phonenumber){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT phoneNumber FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['phoneNumber'] != $phonenumber){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyAdressChanged($companyId, $adress){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT adress FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['adress'] != $adress){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyPostboxChanged($companyId, $postbox){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT postbox FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['postbox'] != $postbox){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyPostnumberChanged($companyId, $postnumber){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT postnumber FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['postnumber'] != $postnumber){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyPostplaceChanged($companyId, $postplace){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT postplace FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['postplace'] != $postplace){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyHomepageChanged($companyId, $homepage){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT homepage FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['homepage'] != $homepage){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyParentCompanyChanged($companyId, $parentCompanyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT subgroupOfID FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['subgroupOfID'] != $parentCompanyId){
                return true;
            }
        endforeach;
    }
    
    public function hasCompanyStatusChanged($companyId, $status){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT status FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['status'] != $status){
                return true;
            }
        endforeach;
    }
    
    public function addCompanyNameUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'Bedriftens navn har blitt oppdatert', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function deleteAllCompanySpecializationsByCompanyId($companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
        );
        $sql = "DELETE FROM bk_company_specialization WHERE companyId = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
}
