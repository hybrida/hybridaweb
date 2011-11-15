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


		$sql = "SELECT title, n.imageId, content, firstName, middleName, lastName, timestamp
				FROM news n, user_new u 
				WHERE  n.author = u.id
				AND n.id = :id ";
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

	public function actionCreate() {
		$this->forward("news/edit");
	}

	public function actionEdit($id=null) {

		$newsModel = $this->getNewsModel($id);

		$model = new NewsEventForm($newsModel);
		$isUpdated = false;

		if (isset($_POST['NewsEventForm'])) {
			$input = $_POST['NewsEventForm'];
			print_r($input);
			$model->setAttributes($input, false);
			$model->printFields();
			$model->save();
			echo "newsId: " . $model->getNewsModel()->id;
			echo "eventId: " . $model->getEventModel()->id;
			echo "signupId: " . $model->getSignupModel()->primaryKey;

			$this->redirectAfterEdit($model);
			return;
		}

		$this->render("edit", array(
			'model' => $model,
			'updated' => $isUpdated,
		));
	}

	public function getNewsModel($id) {
		$model = News::model()->findByPk($id);
		if ($model) {
			return $model;
		}
		return new News;
	}

	private function redirectAfterEdit($model) {
		$newsModel = $model->getNewsModel();
		if (!$newsModel->isNewRecord) {
			$this->redirect(array(
				"news/view",
				"id" => $newsModel->id
			));
		}
	}

}