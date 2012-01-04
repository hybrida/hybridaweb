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
		$model = Site::model();
		$data = $model->findAll("siteId = 2");
		$this->render('tabNavigation',array('model' => $model, 'data'=>$data));
	}

}