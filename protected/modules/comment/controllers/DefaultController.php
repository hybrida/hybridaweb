<?php

class DefaultController extends Controller {

	public function actionSubmit() {
		if (Yii::app()->user->isGuest) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}
		$model = new CommentForm();

		if (isset($_POST['CommentForm'])) {
			$model->attributes = $_POST['CommentForm'];
			$model->save();
			Yii::app()->notification->notifyAndAddListener(
					$model->type,
					$model->id,
					Notification::STATUS_NEW_COMMENT,
					user()->id,
					$model->commentID);
			$this->actionView($model->type, $model->id);
		} else {
			throw new CHttpException(403, "Du har ikke tilgang");
		}
	}

	public function actionDelete($id) {
		$model = Comment::model()->findByPk($id);
		if (!$model->hasDeleteAccess()) {
			throw new CHttpException(403, "Du har ikke tilgang til å slette denne kommentaren");
		}
		$model->delete();
		$this->actionView($model->parentType, $model->parentId);
	}

	public function actionView($type, $id) {
		$this->renderPartial("_comments", array(
			'models' => Comment::getAll($type, $id),
		));
	}
	
	public function actionGriffOn($id) {
		Griff::add($id, user()->id);
		echo "It's on!!";
	}
	
	public function actionGriffOff($id) {
		Griff::remove($id, user()->id);
		echo "It's off!!";
	}
	

}