<?php

class Bkforms {
    
    public function isCompanyCommentEmpty($comment){
        return ($comment == '' ? true : false);
    }
    
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
}
