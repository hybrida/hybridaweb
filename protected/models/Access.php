<?php

class Access {

	private static $pdo;
	
	const REGISTERED = 2;

	const MEMBER = 3;
	const MALE = 1001;
	const FEMALE = 1002;
	
	const GROUP_START = 4000;
	const GENDER_START = 1000;
	const GRADUATION_YEAR_START = 2000;
	const SPECIALIZATION_START = 3000;

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
		self::insertAccessRelationArray($type, $id, array($access));
	}

	public static function insertAccessRelationArray($type, $id, $array) {
		$access = new AccessRelation($type, $id);
		$access->set($array);
		$access->insert();
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


}