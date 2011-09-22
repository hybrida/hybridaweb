<?php
/**
 * Description of TabNavigation
 *
 * @author sigurd
 */
class TabNavigation extends CWidget {
	
	public function init() {
		parent::init();
	}
	
	public function run() {
		$hei = "test";
		$this->render('tabNavigation',array($hei));
	}

	

}