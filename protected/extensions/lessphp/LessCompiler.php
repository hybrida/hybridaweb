<?php

require dirname(__FILE__) . "/lessc.inc.php";

class LessCompiler extends CComponent {

	public function init() {
	}

	public function compileFile($fname, $outFname = null) {
		$l = new lessc;
		return $l->compileFile($fname, $outFname);
	}

	public function compile($string, $name = null) {
		$l = new lessc;
		return $l->compileFile($string, $name);
	}

}