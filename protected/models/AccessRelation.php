<?php

class AccessRelation {

	private $pdo;
	private $id;
	private $type;
	private $model;
	private $insertAccess;
	private $access;

	public function __construct($modelOrType, $id=null) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$this->insertAccess = array();
		if ($id) {
			$this->initTypeId($modelOrType, $id);
		} else {
			$this->setModel($modelOrType);
		}
		$this->initAccess();
	}

	private function initAccess() {
		if ($this->validate()) {
			$this->fetch();
			$this->access = $this->insertAccess;
		}
	}

	private function initTypeId($type, $id) {
		$this->type = $type;
		$this->id = $id;
	}

	public function setModel($model) {
		$this->throwExceptionsIfNotValid($model);
		$this->initModel($model);
	}

	private function throwExceptionsIfNotValid($model) {
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
			$this->id = $this->model->primaryKey;
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
		$this->insertAccess = $accessArray;
	}

	public function replace() {
		$this->removeAll();
		$this->insert();
	}

	public function insert() {
		$this->updateId();
		if ( $this->validate() ) {
			$this->fetch();
			$this->performInsert();
			$this->insertAccess = array();
		} else {
			throw new BadMethodCallException("The model is not saved yet");
		}
	}

	public function validate() {
		return $this->id != null && $this->type != "";
	}

	private function performInsert() {
		$access = null;
		$sql = <<<SQL
			INSERT INTO access_relations (id, access, type) 
				VALUES
				( :id, :access, :type)
SQL;
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);
		$stmt->bindParam(":access", $access);

		$insertArray = array_unique($this->insertAccess);
		foreach ($insertArray as $access) {
			if (in_array($access, $this->access)) {
				continue;
			}
			$stmt->execute();
		}
	}

	public function get() {
		$this->fetch();
		return $this->access;
	}

	private  function fetch() {
		$sql = <<<SQL
SELECT access FROM access_relations
	WHERE id = :id AND type = :type
SQL;
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);
		$stmt->execute();
		$accessArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

		$this->access = $accessArray;
	}

	public function removeAll() {
		$this->access = array();

		$sql = "DELETE FROM access_relations WHERE id = :id AND type = :type";
		$params = array(
		  ":id" => $this->id,
		  ":type" => $this->type,
		);

		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
	}

	public function remove($access) {
		$this->removeFromAccessField($access);
		$this->removeFromInsertAccessField($access);
		
		if (is_array($access)) {
			$this->performRemove($access);
		} else {
			$this->performRemove(array($access));
		}
		
	}

	private function removeFromInsertAccessField($access) {
		foreach ($this->insertAccess as $key => $value) {
			if ($value == $access) {
				unset($this->insertAccess[$key]);
			}
		}
	}

	private function removeFromAccessField($access) {
		foreach ($this->access as $key => $value) {
			if ($value == $access) {
				unset($this->access[$key]);
			}
		}
	}
	
	private function performRemove($accessArray) {
		$access = null;
		
		$sql = "DELETE FROM access_relations WHERE id = :id AND type = :type AND access = :access";
		
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);
		$stmt->bindParam(":access", $access);
		foreach ($accessArray as $access) {
			$stmt->execute();
		}
	}


}