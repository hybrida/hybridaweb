<?php

class AccessField extends CWidget {

	public $model;
	public $attribute;
	public $options;
	public $access;

	public function init() {
		CHtml::resolveNameID($this->model, $this->attribute, $this->options);
		$this->initAccess();
		$this->initAssets();
	}
	
	public function initAssets() {
		$cssDir = Yii::getPathOfAlias('application.components.widgets.assets.accessField.css') . "/access.css";
		$am = Yii::app()->getAssetManager();
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($am->publish($cssDir));
	}
	public function initAccess() {
		$path = explode('[', str_replace("]", "", $this->attribute));
		$access = $this->model->getAttributes();
		foreach ($path as $p) {
			$access = $access[$p];
		}
		$this->access = $access;
	}

	public function run() {
		$this->render('accessField', array(
			'name' => $this->options['name'],
			'groups' => $this->getAccessGroups(),
		));
	}

	public function getChecked($access) {
		return in_array($access, $this->access) ? "checked" : "";
	}

	public function getName($access) {
		return $this->options['name'] . "[$access]";
	}

	public function getAccessGroups() {
		return array(
			'Generelt' => array(
				'Innloggede' => Access::REGISTERED,
			),
			'Kjønn' => array(
				'Mann' => Access::MALE,
				'Kvinne' => Access::FEMALE,
			),
			'Utgangsår' => $this->getYears(),
			'Grupper' => $this->getGroups(),
			'Spesialisering' => $this->getSpecialisations(),
		);
	}

	private function getYears() {
		$years = array();
		for ($i = 2012; $i < 2016; $i++) {
			$years[$i] = $i;
		}
		return $years;
	}

	private function getGroups() {
		$groups = Groups::model()->findAll();
		$outputArray = array();
		foreach ($groups as $group) {
			$outputArray[$group->title] = Access::GROUP_START + $group->id;
		}
		return $outputArray;
	}

	private function getSpecialisations() {
		return array();
	}

}