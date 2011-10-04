<?php

class Access {

	private $pdo;

	public function __construct() {
		$this->pdo = Yii::app()->db->getPdoInstance();
	}

	public function insertMembership($groupId, $userId) {
		$data = array(
				'gId' => $groupId,
				'uId' => $userId
		);

		$sql = "INSERT INTO membership_access VALUES (
            (SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID)),:uID)";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
	}

	public function deleteMembership($groupId, $userId) {
		$data = array(
				'gId' => $groupId,
				'uId' => $userId
		);

		$sql = "DELETE FROM membership_access WHERE groupId = 
            (SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID))
            AND userId = :uID";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
	}

	//Slette tilgangsnivåer til gruppen
	public function deleteAccessRelation($type, $id) {
		$data = array(
				'type' => $type,
				'id' => $id
		);

		$sql = "DELETE FROM access_relations WHERE type = :type AND id = :id";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
	}

	public function insertAccessRelation($id, $accessId, $type) {
		$data = array(
				'sID' => $id,
				'accessID' => $accessId,
				'type' => $type
		);
		print_r($data);
		$sql = "INSERT INTO access_relations VALUES (:sID,:accessID,:type)";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
	}

	public function deleteAccessDefinition($description) {
		$data = array(
				'name' => $description
		);

		$sql = "DELETE FROM access_definition WHERE description = :name";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
	}

	public function insertAccessDefinition($description) {
		$data = array(
				'name' => $description
		);

		$sql = "INSERT INTO access_definition VALUES (null, :name)";
		$query = $this->pdo->prepare($sql);
		$query->execute($data);

		return $this->pdo->lastInsertId();
	}

	public static function innerSQLAllowedTypeIds() {
		return "(SELECT ar.id AS accessId, ma.userId FROM membership_access ma LEFT JOIN access_relations ar ON ma.accessId=ar.access 
		WHERE ar.type=:type AND ma.userId = :userId) AS a ON a.accessId";
	}

}

?>
