<?php

class AccessRelation {

	private $pdo;
	private $id;
	private $type;
	private $model;
	private $access;

	public function __construct($model) {
		$this->pdo = Yii::app()->db->getPdoInstance();
		$this->setModel($model);
	}

	public function setModel($model) {
		$this->validateModelAndThrowsExceptions($model);
		$this->init($model);
	}

	private function validateModelAndThrowsExceptions($model) {
		if ($model == null) {
			throw new NullPointerException();
		}
		if (!$this->getTypeFromModel($model)) {
			throw new IllegalArgumentException(
					"Model must be an instance of Event, News or Article");
		}
	}

	private function init($model) {
		$this->id = $model->id;
		$this->type = $this->getTypeFromModel($model);
		$this->model = $model;
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

	public function insert($accessArray) {
		if ($this->validates()) {
			$this->insertIntoDatabase($accessArray);
		} else {
			throw new InvalidArgumentException();
		}
	}

	public function validates() {
		if ($this->model->isNewRecord) {
			return false;
		}
		return true;
	}

	private function insertIntoDatabase($accessArray) {
		$oldAccess = $this->get();
		$sql = <<<SQL
			INSERT INTO access_relations (id, access, type) 
				VALUES
				( :id, :access, :type)
SQL;
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":type", $this->type);

		$access = $accessArray[0];
		$stmt->bindParam(":access", $access);
		foreach ($accessArray as $access) {
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
		
		$sql = <<<SQL
		DELETE FROM access_relations
			WHERE id = :id AND type = :type
SQL;
		$stmt = Yii::app()->db->createCommand()
				->delete("access_relations","id = :id AND type = :type",
				array(
				  ":id" => $this->id,
				  ":type" => $this->type,
				));

	}

}