<?php

class JobAnnouncementModule extends CWebModule {

	public function init() {
		$this->setImport(self::getImports());
	}

	public static function getImports() {
		return array(
			'jobAnnouncement.models.*',
			'jobAnnouncement.components.*',
		);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else {
			return false;
		}
	}

}
