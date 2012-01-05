<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BkDefault
 *
 * @author frans
 */
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
}
