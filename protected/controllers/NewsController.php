<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsController
 *
 * @author sigurd
 */
class NewsController extends Controller {


	public function actionIndex() {
		$this->actionFeed();
	}

	//put your code here

	public function actionView($id) {

		$this->render("view", $a);
	}

	public function actionFeed() {
		
		$selfId = Yii::app()->session['self_id'];




		$query = "SELECT ma.userId FROM groups AS g  
	LEFT JOIN access_definition AS ad ON g.title = ad.description  
	LEFT JOIN membership_access AS ma ON ma.accessId = ad.id 
	WHERE ma.userId = :selfId";
		
		$command = Yii::app()->db->createCommand($query);
		$command->bindParam(':selfId', $selfId);
		$reader = $command->query();
		$data = $reader->readAll();
		
		$this->render("feed",array('data' => $data));

	}
	
	public function actionCreate($id=null) {
		$model = News::model()->findByPk($id);
		
		if ( ! isset($_POST['news'])) {
			
		} else {
			foreach ($_POST['news'] as $key => $value) {
				$model->$key = $value;
			}
			$model->save();
			
		}
			

		
	}
	
	public function actionUpdate($id) {
		$model=News::model()->findByPk($id);
		
		

	}
	
	

}

?>
