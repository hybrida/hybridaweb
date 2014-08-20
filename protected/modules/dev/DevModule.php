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
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			$this->throwExceptionIfBadServerName();
			return true;
		}
		else
			return false;
	}

	private function throwExceptionIfBadServerName() {
		$serverName = Yii::app()->request->serverName;
		$badServerName = "/hybrida.no/";
		$isBadServer = preg_match($badServerName, $serverName);
		if ($isBadServer) {
			throw new CHttpException(403, "Kun for medlemmer av webkomiteen");
		}
	}


}
