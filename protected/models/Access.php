<?php

class Access {

	private static $pdo;
	
	const MEMBER = 3;
	const MALE = 4;
	const FEMALE = 5;
	

	public function __construct() {
		self::$pdo = Yii::app()->db->getPdoInstance();
	}

	//Slette tilgangsnivåer til gruppen
	public static function deleteAccessRelation($type, $id, $access) {
		self::$pdo = Yii::app()->db->getPdoInstance();
		$data = array(
				'type' => $type,
				'id' => $id,
				'access' => $access
		);

		$sql = "DELETE FROM access_relations WHERE type = :type AND id = :id AND access = :access";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	public static function deleteAllAccessRelation($type, $id) {
		self::$pdo = Yii::app()->db->getPdoInstance();
		$data = array(
				'type' => $type,
				'id' => $id,
		);

		$sql = "DELETE FROM access_relations WHERE type = :type AND id = :id";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	public static function insertAccessRelation($type, $id, $access) {
		self::insertAccessRelationArray($type,$id, array($access));
	}

	public static function insertAccessRelationArray($type, $id,$array) {
		self::$pdo = Yii::app()->db->getPdoInstance();
		$access = $array[0];

		$sql = "INSERT INTO access_relations (id, access, type) VALUES (:id, :access, :type)";
		$stmt = self::$pdo->prepare($sql);
		
		$stmt->bindParam("type",$type);
		$stmt->bindParam("id",$id);
		$stmt->bindParam("access",$access);
		print "ID: $id";
		
		foreach ($array as $access) {
			$stmt->execute();
		}
	}

	public static function getAccessRelation($type, $id) {
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

		$sql = "INSERT INTO access_definition (id, description) VALUES (null, :name)";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);

		return self::$pdo->lastInsertId();
	}

	public static function getAccessDefinition($description) {
		$data = array(
				'name' => $description
		);

		$sql = "SELECT id from access_definition WHERE description = :name";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['id'];
	}

	public static function innerSQLAllowedTypeIds() {
		return "(SELECT ar.id AS accessId, ma.userId FROM membership_access ma LEFT JOIN access_relations ar ON ma.accessId=ar.access 
		WHERE ar.type=:type AND ma.userId = :userId) AS a ON a.accessId";
	}

}

?>
