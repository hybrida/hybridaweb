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

	public function actionIndex($id) {
		echo $id;
	}

	//put your code here

	public function actionView($id) {


		$sql = "SELECT title, n.imageId, content, firstName, middleName, sirName, timestamp
				FROM news n, user_info u 
				WHERE  n.author = u.userId 
				AND n.id = :id 
				ORDER BY timestamp DESC";
		$query = Yii::app()->db->createCommand($sql);
		$data = $query->query(array("id" => $id));
		$a = $data->read();
		
		if ($a == array()) {
			throw new CHttpException("Nyheten finnes ikke");
		}



		$this->render("index", $a);
	}

}
?>
