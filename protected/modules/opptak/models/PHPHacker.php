<?php

function shout($string) {
	PHPHacker::$counter++;
	if (PHPHacker::$counter > 100) {
		die('Dette orker jeg ikke lenger!
			Jeg er overopphetet. Stikker til nordligere strøk!');
	}
}

class PHPHacker extends CFormModel {

	public $php;
	public static $counter = 0;
	public $output = "";

	function __construct() {
		
	}

	public function runCode() {
		ob_start();
		eval($this->php);
		$this->output = ob_get_contents();
		ob_clean();
		if (self::$counter == 20) {
			return "Greit da!\npassordet er: password";
		}
		elseif(self::$counter < 20 ) {
			return "Neida neida. Dette holder ikke. passordet er hemmelig";
		} else {
			return "Du maser jo altformye! Dette orker jeg ikke!
				Jeg er overopphetet og stikker nordover. Snakkes...";
		}
	}
	
	
}