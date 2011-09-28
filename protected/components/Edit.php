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

	/** The default access that should be set if not specified */
	


	public function __construct() {

		$this->con = DbConnector::getDbConnector();
		$this->err = $this->con->getErrorHandler();
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

		$sql = "SELECT $scope FROM {$this->tableName} WHERE {$this->idName} = '$id'";

		$result = $this->con->query($sql);

		$table = $this->con->fetch($result);
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

		$sql = "UPDATE {$this->tableName} SET ";
		foreach ($this->fields as $key => $value) {
			if ($value !== null && !in_array($key, $this->updateFilter)) {
				$sql .= "$key =  '$value' ,";
			}
		}
		$sql = substr($sql, 0, -1);
		$sql .= " WHERE {$this->idName} = " . $this->fields[$this->idName];

		$this->con->query($sql, "{$this->tableName}->update()");

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
			$sql = "INSERT INTO access_relations VALUES (
				{$this->fields[$this->idName]} ,
				$value ,
				'{$this->tableName}'
			);";

			$this->con->query($sql, "access.{$this->tableName}");
		}
	}

	/** Edits the access_relations posts for this element */
	public function updateAccess() {
		$id = $this->getId();

		foreach ($this->access as $newAccess) {
			$funnet = false;
			foreach ($this->oldAccess as $oldAccess) {
				if ($newAccess == $oldAccess) {
					$funnet = true;
					break;
				}
			}
			if ($funnet) {
				continue;
			}
			$sql = "INSERT INTO access_relations VALUES (
				$id , $newAccess , '{$this->tableName}'
			);";

			$this->con->query($sql, "access.{$this->tableName}");
		}

		foreach ($this->oldAccess as $oldAccess) {
			$funnet = false;
			foreach ($this->access as $newAccess) {
				if ($newAccess == $oldAccess) {
					$funnet = true;
					break;
				}
			}
			if ($funnet) {
				continue;
			}
			$sql = "DELETE FROM `hybrida`.`access_relations` WHERE
				`access_relations`.`id` = $id AND
				`access_relations`.`access` = $oldAccess AND
				`access_relations`.`type` = '{$this->tableName}'";

			$this->con->query($sql, "access.{$this->tableName}");
		}
		echo "\n";
	}

	/**
	 * Returns the set of access'
	 * @return array
	 */
	public function fetchAccess() {
		$sql = "SELECT access FROM access_relations " .
			" WHERE id = '" . $this->getId() .
			"' AND type = '{$this->tableName}'";

		$result = $this->con->query($sql);

		$tmp = $this->con->fetch($result);


		while ($tmp) {
			$this->access[] = $tmp['access'];
			$tmp = $this->con->fetch($result);
		}
		$this->err->message("Access burde ha vært funnet nå, med èn fetch-error");
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

