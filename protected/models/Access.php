<?php

class Access {

	private static $pdo;

	public function __construct() {
		self::$pdo = Yii::app()->db->getPdoInstance();
	}

	public function insertMembership($groupId, $userId) {
		$data = array(
				'gId' => $groupId,
				'uId' => $userId
		);

		$sql = "INSERT INTO membership_access VALUES (
            (SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID)),:uID)";
		$query = self::$pdo->prepare($sql);
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
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	//Slette tilgangsnivåer til gruppen
	public static function deleteAccessRelation($type, $id) {
		self::$pdo = Yii::app()->db->getPdoInstance();
		$data = array(
				'type' => $type,
				'id' => $id
		);

		$sql = "DELETE FROM access_relations WHERE type = :type AND id = :id";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	public static function insertAccessRelation($id, $accessId, $type) {
		self::insertAccessRelationArray(array($accessId), $id, $type);
	}

	public static function insertAccessRelationArray($array, $id, $type) {
		self::$pdo = Yii::app()->db->getPdoInstance();

		$sql = "INSERT INTO access_relations VALUES (:id, :access, :type)";
		$stmt = self::$pdo->prepare($sql);

		$access = "";
		$stmt->bindParam("id", $id);
		$stmt->bindParam("access", $access);
		$stmt->bindParam("type", $type);

		foreach ($array as $access) {
			$stmt->execute($data);
		}
	}

	public static function getAccessRelation($id, $type) {
		self::$pdo = Yii::app()->db->getPdoInstance();

		$sql = "SELECT access 
			FROM access_relations
			WHERE id = :id
				AND type = :type";

		$stmt = self::$pdo->prepare($sql);
		$stmt->bindValue("id", $id);
		$stmt->bindValue("type", $type);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
		return $data;
	}

	public static function deleteAccessDefinition($description) {
		$data = array(
				'name' => $description
		);

		$sql = "DELETE FROM access_definition WHERE description = :name";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	public function insertAccessDefinition($description) {
		$data = array(
				'name' => $description
		);

		$sql = "INSERT INTO access_definition VALUES (null, :name)";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);

		return self::$pdo->lastInsertId();
	}

	public static function innerSQLAllowedTypeIds() {
		return "(SELECT ar.id AS accessId, ma.userId FROM membership_access ma LEFT JOIN access_relations ar ON ma.accessId=ar.access 
		WHERE ar.type=:type AND ma.userId = :userId) AS a ON a.accessId";
	}

}

?>
