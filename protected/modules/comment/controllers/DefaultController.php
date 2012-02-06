<?php

class DefaultController extends Controller {

	public function actionForm() {
		$model = new CommentForm();

		if (isset($_POST['CommentForm'])) {
			// Se at POST har en nøkkel id og en nøkkel type
			// lage nytt commentarForm med type, id

			$model->attributes = $_POST['CommentForm'];
			$model->save();
			$this->redirectAfterCommentUpload($model);
		} else {
			throw new CHttpException(500, "Ikke tillat");
		}
	}

	public function redirectAfterCommentUpload($model) {
		$r = "";
		switch ($model->type) {
			case 'news':
				$r = $this->createUrl('/news/view', array('id' => $model->id));
				break;
		}
		if ($r)
			$this->redirect($r);
	}

}