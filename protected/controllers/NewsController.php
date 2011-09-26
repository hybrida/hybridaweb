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
		$this->render("index");
	}

	//put your code here

	public function actionView($id) {


		$sql = "SELECT title, n.imageId, content, firstName, middleName, sirName, timestamp
				FROM news n, user_info u 
				WHERE  n.author = u.userId 
				AND n.id = :id 
				ORDER BY timestamp DESC";
		$command = Yii::app()->db->createCommand($sql);

		$query = $command->query( array(
				"id" => $id,
		));
		
		$data = $query->read();

		if ($data == array()) {
			throw new CHttpException("Nyheten finnes ikke");
		}
		
		$data['content'] = nl2br($data['content']);
		



		$this->render("view", $data);
	}

}
?>
