<?php

/**
 * This class handles trivial operations on the signup table in the 
 * database.
 */
class Signup extends Edit {

	function __construct() {
		parent::__construct();

		$this->fields = array(
				'eventId' => null,
				'spots' => null,
				'open' => null,
				'close' => null,
				'signoff' => null,
				'active' => null,
		);

		$this->updateFilter = array('eventId');
		$this->setFilter = array('eventId');
		$this->pushFilter = array();

		$this->tableName = "signup";
		$this->idName = 'eventId';
	}

	function push() {
		$this->fields['active'] = 1;
		parent::push();
	}

	/**
	 * Returns true if the signup is active.
	 * @return boolean
	 */
	function isActive() {
		return $this->fields['active'];
	}

	/**
	 * Alters the `active` field	 *
	 *
	 * @param boolean $active
	 */
	function setActive($active) {
		$this->fields['active'] = $active;
	}

	/**
	 * Sets the signup-id. Should be used when creating a new signup
	 * @param int $id
	 */
	public function setId($id) {
		parent::setId($id);
	}

}
