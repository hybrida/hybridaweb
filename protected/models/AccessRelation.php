<?php

class AccessRelation {

	private $pdo;
	private $id;
	private $type;
	private $model;
	private $_access;

	public function __construct($modelOrType, $id=null) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$this->_access = array();
		if ($id) {
			$this->initTypeId($modelOrType, $id);
		} else {
			$this->setModel($modelOrType);
		}
	}

	private function initTypeId($type, $id) {
		$this->type = $type;
		$this->id = $id;
	}

	public function setModel($model) {
		$this->validateModelAndThrowExceptions($model);
		$this->initModel($model);
	}

	private function validateModelAndThrowExceptions($model) {
		if ($model == null) {
			throw new NullPointerException();
		}
		if (!$this->getTypeFromModel($model)) {
			throw new InvalidArgumentException(
					"Model must be an instance of Event, News or Article");
		}
	}

	private function initModel($model) {
		$this->model = $model;
		$this->updateId();
		$this->type = $this->getTypeFromModel($model);
	}

	private function updateId() {
		if ($this->model)
			$this->id = $this->model->id;
	}

	private function getTypeFromModel($model) {
		if ($model instanceof News) {
			return "news";
		} else if ($model instanceof Event) {
			return "event";
		} else if ($model instanceof Article) {
			return "article";
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
		$this->_access = $accessArray;
	}

	public function save() {
		$this->delete();
		$this->insert();
	}

	public function insert() {
		$this->updateId();
		if ($this->validates()) {
			$this->insertIntoDatabase();
		} else {
			throw new BadMethodCallException("The model is not saved yet");
		}
	}

	public function validates() {
		return $this->id != null && $this->type != "";
	}

	private function insertIntoDatabase() {
		$oldAccess = $this->get();
		$sql = <<<SQL
			INSERT INTO access_relations (id, access, type) 
				VALUES
				( :id, :access, :type)
SQL;
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);

		$access = null;
		$stmt->bindParam(":access", $access);
		foreach ($this->_access as $access) {
			if (in_array($access, $oldAccess)) {
				continue;
			}
			$stmt->execute();
		}
	}

	public function get() {
		$sql = <<<SQL
SELECT access FROM access_relations
	WHERE id = :id AND type = :type
SQL;
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);
		$stmt->execute();
		$accessArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

		return $accessArray;
	}

	public function delete() {
		$conditions = "id = :id AND type = :type";
		$params = array(
		  ":id" => $this->id,
		  ":type" => $this->type,
		);
		$stmt = Yii::app()->db->createCommand()
				->delete("access_relations", $conditions, $params);
	}

}