<?php

class DevModule extends CWebModule {

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
			'dev.models.*',
			'dev.components.*',
		));
		$this->throwExceptinIfBadServerName();
	}

	public function throwExceptinIfBadServerName() {
		$serverName = Yii::app()->request->serverName;
		$badServerName = "/hybrida.no/";
		$isBadServer = preg_match($badServerName, $serverName);
		if ($isBadServer) {
			throw new CHttpException('Ingen tilgang', "Denne siden er kun tilgjengelig for webkom-medlemmer");
		}
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

}
