<?php

class SSOMock {

	public $loginvalues;

	function __construct($data) {
		$this->loginvalues = array();

		// parse the data-field
		$dataar = explode(",", $data);
		while ($k = array_shift($dataar)) {
			$this->loginvalues[$k] = array_shift($dataar);
			// if this value is a list
			if (strstr($this->loginvalues[$k], ":")) {
				$this->loginvalues[$k] = explode(":", $this->loginvalues[$k]);
			}
		}
	}

	function verifies() {
		return true;
	}

	function oktime() {
		return true;
	}

	function okip() {
		return true;
	}

	function oktarget() {
		return true;
	}

	function loginvalues() {
		return $this->loginvalues;
	}

	function reason() {
		return "";
	}

	function oklogin() {
		return true;
	}

}
