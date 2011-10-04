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

	public function __construct() {
		$this->userId = Yii::app()->user->id;
		$this->access = Yii::app()->user->access;
	}

	// FIXME utestet
	public function checkOne($type, $id) {
		$model = AccessRelations::model();
		$conditions = "id = :id AND type = :type";
		$param = array(
				":id" => $id,
				":type" => $type
		);

		$typeAccess = $model->findAllByAttribute("*", $conditions, $param);
		print_r($typeAcces);
		
	}

	/** @deprecated */
	public function checkGroup(array $groups) {

		// Finne groupId til gruppen


		$sql = "SELECT * 
			FROM  `membership_access` 
			WHERE  `accessId` = :accessId
			AND `userId = :userID";
		foreach ($groups as $group) {
			
		}
	}

	public function check(array $array) {
		foreach ($array as $key => $value) {


			switch ($key) {
				case 'groups':
					$this->checkGroup($value);
					break;
				case 'sex':
					$this->checkSex($value);
					break;
				case 'access':
					$this->checkAccess($value);
					break;
			}
		}
	}

}

?>
