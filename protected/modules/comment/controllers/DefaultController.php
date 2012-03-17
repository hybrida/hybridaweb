<?php

class DefaultController extends Controller {

	public function actionSubmit() {
		$model = new CommentForm();

		if (isset($_POST['CommentForm'])) {
			$model->attributes = $_POST['CommentForm'];
			$model->save();
			$this->actionView($model->type, $model->id);
		} else {
			throw new CHttpException(500, "Ikke tillat");
		}
	}

	public function actionView($type, $id) {
		$models = Comment::model()->findAll("parentId = :id AND parentType = :type", array(
			":id" => $id,
			":type" => $type));
		$this->renderPartial("_comments",array(
			'models' => $models
		));
	}

}