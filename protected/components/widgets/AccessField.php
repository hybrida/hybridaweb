<?php

class AccessField extends CWidget {
	
	public $model;
	public $attribute;
	public $options;

	public function init() {
		CHtml::resolveNameID($this->model, $this->attribute, $this->options);
		
	}

	public function run() {
		$this->render('accessField', array(
			
		));
	}
	
}