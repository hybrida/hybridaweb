<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GateKeeper
 *
 * @author sigurd
 */
class GateKeeper {

	private $userId;
	private $access;
	private $pdo;

	public function __construct() {

		$this->isGuest = Yii::app()->user->isGuest;
		$this->userId = 1;
		$this->access = array();

		if ( ! $this->isGuest) {
			$this->userId = Yii::app()->user->id;
			$this->access = Yii::app()->user->access;
			//print_r($this->access);
		}
		$this->pdo = Yii::app()->db->getPdoInstance();
	}

	public function check($type, $id) {
		
		$sql = "SELECT access 
FROM  `access_relations` 
WHERE  `id` = :id
AND  `type` =  :type ";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->bindValue(":type",$type);
		$stmt->execute();
		
		$typeAccess = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($typeAccess as $ac) {
			if (! in_array($ac['access'], $this->access)) {
				return false;				
			}
		}
		
		return true;
		
		
	}


}
