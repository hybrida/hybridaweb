<?php

class AccessField extends CWidget {

	private $_assetsDir = 'application.components.widgets.assets.accessField.css';
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
		$cssDir = Yii::getPathOfAlias($this->_assetsDir) . "/access.css";
		$am = Yii::app()->getAssetManager();
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($am->publish($cssDir));
	}

	public function initAccess() {
		if (!$this->model) {
			$this->access = array();
			return;
		}
		$this->initAccessOnModel();
	}

	private function initAccessOnModel() {
		$path = explode('[', str_replace("]", "", $this->attribute));
		if (method_exists($this->model, "getAccess")) {
			$access = $this->model->getAccess();
		} else {
			$access = $this->model->getAttributes();
			foreach ($path as $p) {
				$access = $access[$p];
			}
		}
		$this->access = $access;
		$this->initAccessSubs();
	}

	private function initAccessSubs() {
		if (empty($this->access)) {
			$this->sub = 1;
		} else if (is_array($this->access[0])) {
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
				'subs' => $this->getSubCount(),
			));
		}
	}

	private function getSubCount() {
		if (!empty($this->access)) {
			if (is_array($this->access[0])) {
				$count = count($this->access);
				print($count);
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