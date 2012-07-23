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
	}

	public function initNameID() {
		if ($this->model) {
			$array = array();
			CHtml::resolveNameID($this->model, $this->attribute, $array);
			$this->name = $array['name'];
			$this->id = $array['id'];
		}
	}

	public function run() {
		if ($this->isAjaxRequest) {
			$this->render('accessField/_field', array(
				'sub' => $this->sub,
			));
		} else {
			$this->render('accessField/field', array(
				'subs' => $this->getSubCount(),
			));
		}
	}

	private function getSubCount() {
		if (!empty($this->access)) {
			if (is_array($this->access[0])) {
				$count = count($this->access);
				return count($this->access);
			} else {
				return 1;
			}
		}
		return 0;
	}

	public function getChecked($access, $sub) {
		if (!empty($this->access)) {
			if (is_array($this->access[0])) {
				$bol = false;
				if (isset($this->access[$sub])) {
					$bol = in_array($access, $this->access[$sub]);
				}
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
				'Mann' => Access::MALE,
				'Kvinne' => Access::FEMALE,
			),
			'Utgangsår' => $this->getYears(),
			'Grupper' => $this->getGroups(),
			'Spesialisering' => $this->getSpecializations(),
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
			$outputArray[$group->url] = Access::GROUP_START + $group->id;
		}
		return $outputArray;
	}

	private function getSpecializations() {
		$stmt = app()->db->createCommand()
				->select('id, name')
				->from('specialization')
				->queryAll();
		$specs = array();
		foreach ($stmt as $spec) {
			$specs[$spec['name']] = Access::SPECIALIZATION_START + $spec['id'];
		}
		return $specs;
	}

}