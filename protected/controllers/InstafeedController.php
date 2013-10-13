<?php



class InstafeedController extends Controller {
    
 	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("index"),
				'users' => array('@'),
			),
			array('deny'),
		);
	}
    
    
    public function actionIndex() {
        $this->render('index');
    }
}