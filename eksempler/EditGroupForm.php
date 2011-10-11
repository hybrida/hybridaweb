<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditGroupForm
 *
 * @author sigurd
 */
class EditGroupForm extends CFormModel {
	public $a;
	public $b;
	public $c;
	
	
	public function rules() {
		return array(
				array('a, b, c','validates')
		);
	}
	
	public function validates() {
		return true;
	}
	
	public function save() {
		
	}
	//put your code here
}

?>
