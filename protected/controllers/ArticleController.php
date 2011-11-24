<?php

class ArticleController extends Controller {

	public function actionView($id) {
		$model = Article::model()->findByPk($id);
		if ($model !== null) {
			$data = $model->getAttributes();

			$this->render("view", $data);
		}
	}
    public function actionEdit($id){
		$model = $this->getArticleModel($id);
		
        $this->render('edit',$model);
    }
    
    public function getArticleModel($id) {
        $model = Article::model()->findByPk($id);
        if ($model)
            return $model;
        else
            throw new CHttpException("Artikkelen finnes ikke");
	}
}