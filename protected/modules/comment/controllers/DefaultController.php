<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}

	public function actionForm() {
		$model = new CommentForm();

		if (isset($_POST['CommentForm'])) {
			// Se at POST har en nøkkel id og en nøkkel type
			// lage nytt commentarForm med type, id
			
			$model->attributes = $_POST['CommentForm'];
			$model->trace();
			echo "<pre>";
			print_r($_POST);
			if ($model->validate()) {
				$model->save();
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('form', array('model' => $model));
	}

}