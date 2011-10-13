<?php

/**
 * @author Sigurd Holsen
 * Can alter any table in a database
 * @abstract
 *
 */
abstract class Edit {

	/** Set of fields in the database table */
	protected $fields = array();
	/** Set of access */
	protected $access = array();
	/** Set of access before a new update */
	protected $oldAccess = array();
	/** Set of fields that shouldn't be updated */
	protected $updateFilter = array();
	/** Set of fields that shouldn't be inserted in a new post */
	protected $pushFilter = array();
	/** Set of fields that shouldn't be altered */
	protected $setFilter = array();
	/** Name of the database table */
	protected $tableName = "";
	/** name of the id field in the database table */
	protected $idName = "id"; // må overskrives i en subklasse
	/** Database-connector. Of class DbConnector */
	protected $con;
	/** ErrorHandler */
	protected $err;

	/** PDO instance */
	protected $pdo;

	/** The default access that should be set if not specified */


	public function __construct() {

		$this->pdo = Yii::app()->db->getPdoInstance();
		// $this->err = $this->con->getErrorHandler();
	}


	/**
	 * Sets new id for the object
	 * @param int $id
	 */
	protected function setId($id) {
		if ($id) {
			$this->fields[$this->idName] = $id;
		}
	}

	/**
	 * Returns true if operation was successfull.
	 *
	 * @param int $id
	 * @param array $fieldsArray=null
	 * @return boolean
	 * @throws Exception if $fieldsArray contains non-existing fields
	 */
	public function fetch($id, $fieldsArray=null) {
		$scope = "*";
		if ($fieldsArray != null) {
			// Validates the fieldsArray. 
			foreach($fieldsArray as $field) {
				if (!in_array($field,  array_keys($this->fields))) {
					echo "error";
					throw new Exception("Could not find field \"" . $field . "\" in table " . $this->tableName);
				}
			}
			$scope = implode(" , ", $fieldsArray);
			
		}

		$sql = "SELECT $scope 
			FROM {$this->tableName} 
			WHERE :idName = '$id'";

		$stmt = $this->pdo->prepare($sql);

		$stmt->execute(array(
				"idName" =>  $this->idName)
		);
		$table = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($table) {

			foreach ($table as $key => $value) {

				if (!is_numeric($key)) {// korrigerer for tall-indexer
					$this->fields[$key] = $value;
				}
			}
			$this->fetchAccess();
			return true;
		} else {
			// fant ikke classeDetaljer
			$this->err->error("Kunne ikke hente " .
				"{$this->tableName}-rad as :S", "{$this->tableName}->"
				. __FUNCTION__);
		}
		return false;
	}

	/**
	 * Returns the set of all fields and accesses
	 * @return array
	 */
	public function get() {
		$output = $this->fields;
		$output['access'] = $this->getAccess();
		return $output;
	}

	/**
	 * Updates the database. Must be run for the database to update.
	 *
	 * @return void
	 */
	public function update() {
		if ($this->fields[$this->idName] == null)
			return;

		$key = "";
		$value = "";
		
		$sql = "UPDATE {$this->tableName}
			SET :key = :value
			WHERE {$this->idName} = :id";
		
		$command = $this->pdo->prepare($sql);
		$command->bindParam('key',$key);
		$command->bindParam('value',$value);
		$command->bindParam('idName',  $this->idName);;
		$command->bindParam('id', $this->fields[$this->idName]);
		

		foreach ($this->fields as $key => $value) {
			if ($value !== null && !in_array($key, $this->updateFilter)) {
				$command->execute();				
			}
		}

		$this->updateAccess();
	}

	/**
	 * Pushes a new post into the database
	 */
	public function push() {

		$sql = "INSERT INTO {$this->tableName} (";


		// Skriver feltnavn til sql
		foreach ($this->fields as $key => $value) {
			if (in_array($key, $this->pushFilter))
				continue;
			$sql .= "`$key` ,";
		}
		$sql = substr($sql, 0, -1); // Fjerner siste komma
		$sql .= " ) VALUES (";
		// SKriver verdiene til sql
		foreach ($this->fields as $key => $value) {
			if (in_array($key, $this->pushFilter))
				continue;
			$sql .= " '$value' ,";
		}
		$sql = substr($sql, 0, -1); // fjerner siste komma
		$sql .= " );";

		$this->con->query($sql, "{$this->tableName}->add()");

		// Henter siste id
		$sql = "SELECT {$this->idName} FROM {$this->tableName}
			ORDER BY {$this->idName} desc LIMIT 1;";
		$result = $this->con->query($sql, "{$this->tableName}->insert,
			hente siste {$this->tableName}-element");

		$tmp = $this->con->fetch($result);
		$this->fields[$this->idName] = $tmp[$this->idName];


		// Sette ny access
		$this->pushAccess();
	}

	/** Makes a new post in access_relations. */
	public function pushAccess() {
		foreach ($this->access as $value) {
			Access::insertAccessRelation($this->getId(), $value, $this->tableName);
		}
	}
	
	public function updateAccess() {
		Access::deleteAccessRelation($this->tableName, $this->getId());
		$this->pushAccess();		
	}

	public function fetchAccess() {
		Access::getAccessRelation($this->idName, $this->tableName);
	}

	/**
	 * Takes in an array and alters the object. Doesn't alter the database.
	 * @see Edit::update() Alters the database
	 * @see self::push() makes a new post in the database
	 *
	 * @param array $input array med felt=>value i db;
	 */
	public function set($input) {
		$this->oldAccess = $this->access;
		$this->access = array();

		foreach ($input as $iKey => $iValue) {
			foreach ($this->fields as $fKey => $fValue) {
				if ($fKey == $iKey && !in_array($iKey, $this->setFilter)) {
					$this->fields[$iKey] = $iValue;
				}
			}

			if ($iKey == "access") {
				foreach ($iValue as $value) {
					if (!in_array($value, $this->access))
						$this->access[] = $value;
				}
			}
		}
	}

	/**
	 * Returns the if of the object
	 * @return int id
	 */
	function getId() {
		return $this->fields[$this->idName];
	}

	/**
	 *
	 * @return int[]
	 */
	function getAccess() {
		return $this->access;
	}
	
	public function exists() {
		return $this->getId() != null;
	}
	
}

