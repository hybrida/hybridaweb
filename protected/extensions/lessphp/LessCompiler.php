<?php

require dirname(__FILE__) . "/lessc.inc.php";

class LessCompiler extends CComponent {

	private $lessc;

	public function init() {
		$this->lessc = new lessc;
	}

	public function compileFile($fname, $outFname = null) {
		return $this->lessc->compileFile($fname, $outFname);
	}

	public function compile($string, $name = null) {
		return $this->lessc->compileFile($string, $name);
	}

}