<?php

class AccessField extends CWidget {
	
	public $model;
	public $attribute;
	public $attributePath;
	public $options;

	public function init() {
		CHtml::resolveNameID($this->model, $this->attribute, $this->options);
	}

	public function run() {
		$this->render('accessField', array(
			'name' => $this->options['name'],
			'groups' => $this->getGroups(),
		));
	}
	
	public function getChecked($access) {
		
	}
	
	public function getName($access) {
		return "";
	}
	
	public function getGroups() {
		return array(
			'Generelt' => array(
				'Innloggede' => Access::REGISTERED,
			),
			'Kjønn' => array(
				'Mann' => Access::MALE,
			),
			'Utgangsår' => $this->getYears(),
		);
	}
	
}