<?php

class AccessRelation {

	private $pdo;
	private $id;
	private $type;
	private $model;
	private $insertAccessGroups;
	private $accessGroups;

	public function __construct($modelOrType, $id = null) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$this->insertAccessGroups = array();
		if ($id !== null) {
			$this->initTypeId($modelOrType, $id);
		} else {
			$this->setModel($modelOrType);
		}
	}

	private function initTypeId($type, $id) {
		$this->type = $type;
		$this->id = $id;
	}

	private function setModel($model) {
		$this->throwExceptionsIfNotValid($model);
		$this->initModel($model);
	}

	private function throwExceptionsIfNotValid($model) {
		if ($model == null) {
			throw new NullPointerException();
		}
		if (!$this->getTypeFromModel($model)) {
			throw new InvalidArgumentException(
					"Model must be an instance of Event, News or Article or Signup or Album");
		}
	}

	private function initModel($model) {
		$this->model = $model;
		$this->updateId();
		$this->type = $this->getTypeFromModel($model);
	}

	private function updateId() {
		if ($this->model) {
			$this->id = $this->model->primaryKey;
		}
	}

	private function getTypeFromModel($model) {
		if ($model instanceof News) {
			return "news";
		} else if ($model instanceof Event) {
			return "event";
		} else if ($model instanceof Article) {
			return "article";
		} else if ($model instanceof Signup) {
			return "signup";
		} else if ($model instanceof Album) {
			return "album";
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function set($accessArray) {
		if (!is_array($accessArray)) {
			throw new InvalidArgumentException("input must be an array");
		}

		if (!empty($accessArray)) {
			$accessArray = array_values($accessArray);
			if (is_array($accessArray[0])) {
				$this->insertAccessGroups = $accessArray;
			} else {
				$this->insertAccessGroups = array($accessArray);
			}
		}
	}

	public function replace() {
		$this->removeAll();
		$this->insert();
	}

	public function insert() {
		$this->updateId();
		if ($this->validate()) {
			$this->fetch();
			$this->performInsert();
			$this->insertAccessGroups = array(array());
		} else {
			throw new BadMethodCallException("The model is not saved yet");
		}
	}

	public function validate() {
		return $this->id != null && $this->type != "";
	}

	private function performInsert() {
		$insertAccess = $this->insertAccessGroups;
		$stmt = $this->getInsertPdoStatement();
		if ($insertAccess == array()) {
			return;
		}

		foreach ($insertAccess as $key => $accessGroup) {
			$this->performInsertGroup($accessGroup, $stmt, $key);
		}
	}

	private function getInsertPdoStatement() {
		$sql = "INSERT INTO access_relations (id, access, type, super_id)
				VALUES	( :id, :access, :type, :super_id)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":id", $this->id);
		$stmt->bindValue(":type", $this->type);
		$stmt->bindValue(":super_id", 1);
		return $stmt;
	}

	private function performInsertGroup($insertAccess, $stmt, $key) {
		$access = null;
		$stmt->bindParam(':access', $access);
		$stmt->bindParam(':super_id', $key);
		$insertArray = array_unique($insertAccess);
		foreach ($insertArray as $access) {
			if (key_exists($key, $this->accessGroups)) {
				if (in_array($access, $this->accessGroups[$key])) {
					continue;
				}
			}
			$stmt->execute();
		}
	}

	public function get() {
		$this->fetch();
		if (count($this->accessGroups) == 1) {
			return $this->accessGroups[0];
		}
		return $this->accessGroups;
	}

	private function fetch() {
		$sql = "SELECT access, super_id FROM access_relations
					WHERE id = :id AND type = :type";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);
		$stmt->execute();
		$accessArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->accessGroups = $this->putIntoGroupsFromFetchAssoc($accessArray);
		return;
	}

	private function putIntoGroupsFromFetchAssoc($accessArray) {
		$accessGroups = array();
		foreach ($accessArray as $access) {
			$group = $access['super_id'];
			$value = $access['access'];
			$accessGroups[$group][] = $value;
		}
		return $accessGroups;
	}

	public function removeAll() {
		$this->accessGroups = array();

		$sql = "DELETE FROM access_relations WHERE id = :id AND type = :type";
		$params = array(
			":id" => $this->id,
			":type" => $this->type,
		);

		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
	}

	public function save() {
		if (!empty($this->insertAccessGroups)) {
			$this->replace();
		}
	}

}