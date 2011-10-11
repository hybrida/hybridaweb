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


		$sql = "SELECT title, n.imageId, content, firstName, middleName, sirName, timestamp
				FROM news n, user_info u 
				WHERE  n.author = u.userId 
				AND n.id = :id 
				ORDER BY timestamp DESC";
		$query = Yii::app()->db->createCommand($sql);
		$query2 = $query->query(array("id" => $id));
		$data = $query2->read();

		if ($data == array()) {
			throw new CHttpException("Nyheten finnes ikke");
		}



		$this->render("view", $data);
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

		$this->render("feed", array('data' => $data));
	}

	public function actionEdit($id=null) {

		$model = new NewsEventForm;
		$isUpdated = false;


		if (isset($_POST['NewsForm'])) {
			$input = $_POST['NewsForm'];
			$model->setAttributes($input,false);
			$model->testInput();
			
		}

		$this->render("form", array(
				'model' => $model,
				'updated' => $isUpdated,
		));
	}

}
