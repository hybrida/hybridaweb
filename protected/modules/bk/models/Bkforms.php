<?php

class Bkforms {
    
    public function setLogoById($id, $pid){
        $connection = Yii::app()->db;
        $sql = "UPDATE bk_company SET imageID = ". $pid . " WHERE companyID = " . $id;
		$command = $connection->createCommand($sql);
        $command->execute();
    }
    public function addCompanyComment($comment, $id){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'comment' => $comment,
            'companyId' => $id,
            'currentUserId' => Yii::app()->user->id
        );
        $sql = "INSERT INTO comment (parentId, parentType, content, authorId, timestamp) 
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
        $sql = "UPDATE bk_company_update SET isDeleted = 'true' WHERE relevantForUserId = :currentUserId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function deleteAllUpdatesRelevantToUser($id){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'userId' => $id
        );
        $sql = "UPDATE bk_company_update SET isDeleted = 'true' WHERE relevantForUserId = :userId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function deleteUpdateByUpdateId($id){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'updateId' => $id
        );
        $sql = "UPDATE bk_company_update SET isDeleted = 'true' WHERE updateId = :updateId";

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
    
    public function isCompanySet($companyName){
        if($companyName == 0){
            return false;
        }
        else{
            return true;
        }
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
        $sql = "UPDATE user SET altEmail = :altEmail WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateSpecialization($id, $specializationId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'specializationId' => $specializationId
        );
        $sql = "UPDATE user SET specializationId = :specializationId WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateWorkDescription($id, $workDescription){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'workDescription' => $workDescription
        );
        $sql = "UPDATE user SET workDescription = :workDescription WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateWorkPlace($id, $workPlace){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'workPlace' => $workPlace
        );
        $sql = "UPDATE user SET workPlace = :workPlace WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateGraduateGraduationYear($id, $graduationYear){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id,
            'graduationYear' => $graduationYear
        );
        $sql = "UPDATE user SET graduationYear = :graduationYear WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function hasGraduateWorkCompanyChanged($id, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'graduateId' => $id
        );
        $sql = "SELECT companyId FROM bk_company 
                RIGHT JOIN user ON workCompanyID = companyID WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $company) :
            if($company['companyId'] != $companyId){
                return true;
            }
        endforeach;
    }
    
    public function updateGraduateWorkCompany($id, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();
        
        $data = array(
            'graduateId' => $id,
            'companyId' => $companyId
        );
        $sql = "UPDATE user SET workCompanyID = :companyId WHERE id = :graduateId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function addCompanyGraduateUpdate($relevantUserId, $companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'currentUserId' => Yii::app()->user->id,
            'relevantUserId' => $relevantUserId
        );
        $sql = "INSERT INTO bk_company_update (relevantForUserId, companyId, description, addedById, dateAdded) 
		VALUES (:relevantUserId, :companyId, 'En alumnistudent er knyttet til om bedriften', :currentUserId, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function insertCompanyInformation($companyName, $mail, $phonenumber, $address, $postbox, $postnumber, $postplace, $homepage, $parentCompanyId, $status){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyName' => $companyName,
            'mail' => $mail,
            'phonenumber' => $phonenumber,
            'address' => $address,
            'postbox' => $postbox,
            'postnumber' => $postnumber,
            'postplace' => $postplace,
            'homepage' => $homepage,
            'parentCompanyId' => $parentCompanyId,
            'status' => $status,
            'currentUserId' => Yii::app()->user->id
        );
        $sql = "INSERT INTO bk_company (companyName, mail, phonenumber, address, postbox, postnumber, postplace, homepage, subgroupOfID, status, addedByID, updatedByID, dateAdded, dateUpdated) 
		VALUES (:companyName, :mail, :phonenumber, :address, :postbox, :postnumber, :postplace, :homepage, :parentCompanyId, :status, :currentUserId, :currentUserId, now(), now())";

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
    
    public function addCompanyAddressUpdate($relevantUserId, $companyId){
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
		VALUES (:relevantUserId, :companyId, 'Bedriften har blitt satt som en undergruppe', :currentUserId, now())";

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
    
    public function setCompanyAsUpdated($companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "UPDATE bk_company SET dateUpdated = now() WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateCompanyInformation($companyId, $companyName, $mail, $phonenumber, $address, $postbox, $postnumber, $postplace, $homepage, $parentCompanyId, $status){
                $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
            'companyName' => $companyName,
            'mail' => $mail,
            'phonenumber' => $phonenumber,
            'address' => $address,
            'postbox' => $postbox,
            'postnumber' => $postnumber,
            'postplace' => $postplace,
            'homepage' => $homepage,
            'parentCompanyId' => $parentCompanyId,
            'status' => $status,
            'updatedById' => Yii::app()->user->id
        );
        $sql = "UPDATE bk_company SET companyName = :companyName, mail = :mail, phoneNumber = :phonenumber, address = :address, postbox = :postbox,
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
        $sql = "SELECT specializationId FROM bk_company_specialization, specialization 
                WHERE id = specializationId AND companyId = :companyId ORDER BY name ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $edited = 0;
        $original = 0;
        
        foreach ($specializations as $specialization) :
            $edited.=$specialization;
        endforeach;
        
        foreach ($data as $company) :
            $original.=$company['specializationId'];
        endforeach;
        
        if($original != $edited){
            return true;
        }
    }
    
    public function hasCompanyNameChanged($companyId, $companyName){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT companyName FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['companyName'] != $companyName){
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
    
    public function hasCompanyAddressChanged($companyId, $address){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId
        );
        $sql = "SELECT address FROM bk_company WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $company) :
            if($company['address'] != $address){
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
    
    public function nullifyAllCompanySpecializationsByCompanyId($companyId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'companyId' => $companyId,
        );
        $sql = "UPDATE bk_company_specialization 
                SET companyId = 0, specializationId = 0
                WHERE companyID = :companyId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function deleteMemberById($memberId, $groupId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'memberId' => $memberId,
            'groupId' => $groupId
        );
        $sql = "UPDATE group_membership 
                SET end = now()
                WHERE userId = :memberId AND groupId = :groupId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function changeContactingStatusOnRemovalByMemberId($memberId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'memberId' => $memberId
        );
        $sql = "UPDATE bk_company 
                SET status = 'Aktuell senere'
                WHERE contactorID = :memberId AND status = 'Blir kontaktet'";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function isAlreadyGroupMember($memberId, $groupId){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'groupId' => $groupId
        );
        $sql = "SELECT id 
                FROM user, group_membership 
                WHERE groupId = :groupId AND userId = id 
                ORDER BY id ASC";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $user) :
            if($user['id'] == $memberId){
                return true;
            }
        endforeach;
    }
    
    public function addGroupMember($memberId, $groupId, $comission){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'memberId' => $memberId,
            'groupId' => $groupId,
            'comission' => $comission
        );
        $sql = "INSERT INTO group_membership (userId, groupId, comission, start) 
		VALUES (:memberId, :groupId, :comission, now())";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    public function updateMembershipInfo($memberId, $groupId, $start, $end, $comission){
        $this->pdo = Yii::app()->db->getPdoInstance();

        $data = array(
            'memberId' => $memberId,
            'groupId' => $groupId,
            'start' => $start,
            'end' => $end,
            'comission' => $comission
        );
        $sql = "UPDATE group_membership
                SET start = :start, end = :end, comission = :comission
                WHERE userId = :memberId AND groupId = :groupId";

        $query = $this->pdo->prepare($sql);
        $query->execute($data);   
    }
}
