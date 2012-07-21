<?php

class BkModule extends CWebModule {

	private $_assetsDir = "bk.assets";
	private $groupId = 57;

	public function init() {
		$this->setImport(array(
			'bk.models.*',
			'bk.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			$this->initAssets();
			$this->throwErrorIfNotBedkomMember();
			return true;
		}
		else
			return false;
	}

	private function throwErrorIfNotBedkomMember() {
		if (user()->isGuest || !$this->isFormerOrCurrentBedkomMember()) {
			throw new CHttpException(
					400, "Kun for medlemmer av Bedriftskomiteen");
		}
	}

	private function isFormerOrCurrentBedkomMember() {
		return Yii::app()->gatekeeper->hasBeenGroupMember($this->groupId);
	}

	private function initAssets() {
		$this->initCssAssets();
		$this->initScriptAssets();
	}

	private function initCssAssets() {
		$url = $this->getAssetsDir() . "/css/";
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cs->registerCssFile($am->publish($url . 'add-style.css'));
		$cs->registerCssFile($am->publish($url . 'alumni-style.css'));
		$cs->registerCssFile($am->publish($url . 'company-style.css'));
		$cs->registerCssFile($am->publish($url . 'companydistribution-style.css'));
		$cs->registerCssFile($am->publish($url . 'companyoverview-style.css'));
		$cs->registerCssFile($am->publish($url . 'index-style.css'));
		$cs->registerCssFile($am->publish($url . 'updatedelements-style.css'));
	}

	private function initScriptAssets() {
		$url = $this->getAssetsDir() . "/scripts/";
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cs->registerScriptFile($am->publish($url . 'ajax.js'));
		$cs->registerScriptFile($am->publish($url . 'ajax-dynamic-list.js'));
	}

	public function getAssetsDir() {
		return Yii::getPathOfAlias($this->_assetsDir);
	}

}