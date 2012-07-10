<?php

Yii::import('notifications.models.*');

class DefaultController extends Controller {

	public function actionSubmit() {
		$model = new CommentForm();

		if (isset($_POST['CommentForm'])) {
			$model->attributes = $_POST['CommentForm'];
			$model->save();
			Notifications::addListener($model->type, $model->id, user()->id);
			Notifications::notify($model->type, $model->id, Notification::STATUS_NEW_COMMENT);
			$this->actionView($model->type, $model->id);
		} else {
			throw new CHttpException(500, "Ikke tillat");
		}
	}

	public function actionDelete($id) {
		$model = Comment::model()->findByPk($id);
		if (!$this->hasDeleteAccess($model)) {
			throw new CHttpException(403, "Du har ikke rettigheter for å slette denne kommentaren");
		}
		$model->delete();
		$this->actionView($model->parentType, $model->parentId);
	}

	public function hasDeleteAccess($model) {
		return Yii::app()->user->checkAccess("deleteComment", array('authorId' => $model->authorId));
	}

	public function actionView($type, $id) {
		$this->renderPartial("_comments", array(
			'models' => Comment::getAll($type, $id),
		));
	}

}