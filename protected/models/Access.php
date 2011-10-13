<?php

class Access {

	private static $pdo;

	public function __construct() {
		self::$pdo = Yii::app()->db->getPdoInstance();
	}

	public static function insertMembership($groupId, $userId) {
		$data = array(
				'gID' => $groupId,
				'uID' => $userId
		);

		$sql = "INSERT INTO membership_access VALUES (
            (SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID)),:uID)";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	public static function deleteMembership($groupId, $userId) {
		$data = array(
				'gID' => $groupId,
				'uID' => $userId
		);

		$sql = "DELETE FROM membership_access WHERE accessId = 
            (SELECT ad.id FROM access_definition AS ad WHERE description = (SELECT title FROM groups WHERE id=:gID))
            AND userId = :uID";
		$query = self::$pdo->prepare($sql);
		$query->execute($data);
	}

	//Slette tilgangsnivåer til gruppen
    public static function deleteAccessRelation($type, $id, $access){
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

	public static function insertAccessRelation($id, $accessId, $type) {
		self::insertAccessRelationArray(array($accessId), $id, $type);
	}

	public static function insertAccessRelationArray($array, $id, $type) {
		self::$pdo = Yii::app()->db->getPdoInstance();

		$sql = "INSERT INTO access_relations VALUES (:id, :access, :type)";
		$query = self::$pdo->prepare($sql);

		//$access = "";
        foreach ($array as $access) {
            $data = array(
                'id' => $id,
                'access' => $access,
                'type' => $type
            );
            
            $query->execute($data);
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
    
    public static function getAccessDefinition($description){
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
