<?php

class AccessField extends CWidget {

	public $model = null;
	public $attribute;
	public $name;
	public $id;
	public $access = array();
	public $sub = 0;
	public $isAjaxRequest = false;

	public function init() {
		$this->initNameID();
		$this->initAccess();
		$this->initAssets();
	}

	public function initNameID() {
		if ($this->model) {
			$array = array();
			CHtml::resolveNameID($this->model, $this->attribute, $array);
			$this->name = $array['name'];
			$this->id = $array['id'];
		}
	}

	public function initAssets() {
		$cssDir = Yii::getPathOfAlias('application.components.widgets.assets.accessField.css') . "/access.css";
		$am = Yii::app()->getAssetManager();
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($am->publish($cssDir));
	}

	public function initAccess() {
		if (!$this->model) {
			$this->access = array();
			return;
		}
		$path = explode('[', str_replace("]", "", $this->attribute));
		$access = $this->model->getAttributes();
		foreach ($path as $p) {
			$access = $access[$p];
		}
		$this->access = $access;
		$this->initAccessSubs();
	}

	private function initAccessSubs() {
		if (is_array($this->access[0])) {
			$this->sub = count($this->access);
		} else {
			$this->sub = 1;
		}
	}

	public function run() {
		if ($this->isAjaxRequest) {
			$this->render('accessField/_field', array(
				'sub' => $this->sub,
			));
		} else {
			$this->render('accessField/field', array(
				'subs' => $this->getSubCountIndexedBy0(),
			));
		}
	}
	
	private function getSubCountIndexedBy0() {
		if (!empty($this->access)) {
			if (is_array($this->access[0])) {
				return count($this->access) - 1;
			}
		}
		return 0;
	}

	public function getChecked($access, $sub) {
		if (!empty($this->access)) {
			if (is_array($this->access[0])) {
				$bol = in_array($access, $this->access[$sub]);
				return $bol ? "checked" : "";
			}
		}
		return in_array($access, $this->access) ? "checked" : "";
	}

	public function getName($access, $sub) {
		return $this->name . "[$sub][$access]";
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
		for ($i = 2012; $i <= 2016; $i++) {
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
		$stmt = app()->db->createCommand()
				->select('id, name')
				->from('spesialization')
				->queryAll();
		$specs = array();
		foreach ($stmt as $spec) {
			$specs[$spec['name']] = Access::SPECIALIZATION_START + $spec['id'];
		}
		return $specs;
	}

}