<?php

class ArticleController extends Controller {

	public function actionView($id) {
		$model = Article::model()->findByPk($id);
		if ($model !== null) {
			$data = $model->getAttributes();

			$this->render("view", $data);
		}
	}

}