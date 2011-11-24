<?php

class ProfileController extends Controller {

	public $imageId;
	
public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("index","view","edit","all"),
				'users' => array('@')
			),
			array('deny'),
		);
	}

	public function actionIndex() {
		$this->actionView(Yii::app()->user->id);
	}

	public function actionView($id) {
		$this->actionInfo($id);
	}

	public function actionInfo($id) {

		/* $sub = ( isset($_GET['sub']) ? $_GET['sub'] : "0");
		  $id = ( isset($_GET['id']) ? $_GET['id'] : $selfId );		//Id vil være brukerid til profilen vi ønsker å vise
		 */
		//$rbc->setUserImage($id);

		$profile = new Profile();
		$data = $profile->info($id);
		$data['id'] = $id;
		$this->imageId = $data['imageId'];
		$this->render('index', $data);
	}

	public function actionComment($id) {
		$this->render('comment');
	}

	public function actionEdit() {
		$fb = new Facebook();
		$data['fb'] = $fb->authLink();

		$this->render('edit', $data);
	}
    public function actionAll($id){
        $profile = new Profile();
        $data['users'] = $profile->displayMembers($id);
        $data['now'] = date("Y");
		$this->render('all', $data);
	}
    
}