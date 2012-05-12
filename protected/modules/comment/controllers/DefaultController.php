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

	public function actionDelete($id) {
		if (!$this->hasDeleteAccess($id)) {
			throw new CHttpException(403, "Du har ikke rettigheter for å slette denne kommentaren");
		}
		$model = Comment::model()->findByPk($id);
		$model->delete();
		$this->actionView($model->parentType, $model->parentId);
	}
	
	public function hasDeleteAccess($commentId) {
		return Yii::app()->user->checkAccess("deleteComment", array('id' => $commentId));
	}


	public function actionView($type, $id) {
		$this->renderPartial("_comments", array(
			'models' => Comment::getAll($type, $id),
		));
	}

}