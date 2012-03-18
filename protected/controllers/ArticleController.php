<?php

class ArticleController extends Controller {
	
	public function filters() {
		return array(
			'accessControl',
		);
	}
	
    public function actionView($id) {
        $article = $this->getArticleModelAndThrowExceptionIfNullOrNotAccess($id);
		
		$this->render("view", array(
			'article' => $article,
			'hasEditAccess' => user()->checkAccess('updateArticle'),
		));
    }
    
    public function actionCollection(){
		$article = new Article();
        $articleList['menuelements'] = $article->listArticles('wiki');      //Litt for statisk

        $aId = $articleList[0][0];

        $data = $article->getArticle($aId);
		
        $this->renderPartial('menu',$articleList);
        $this->render('view',$data);
    }
	
	public function actionCreate($parentId = null) {
		if(!user()->checkAccess('createArticle')) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}
		
		$model = new Article;
		$model->parentId = $parentId;
		$this->renderArticleForm($model);		
	}
    
    public function actionEdit($id){
		if(!user()->checkAccess('updateArticle', array('id' => $id))) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}
		
		$model = $this->getArticleModel($id);
		$this->renderArticleForm($model);
    }
	
	private function getArticleModelAndThrowExceptionIfNullOrNotAccess($id) {
		$article = Article::model()->findByPk($id);

		if (!$article)
			throw new CHttpException('Artikkelen finnes ikke');
		if (!app()->gatekeeper->hasPostAccess('article', $article->id))
			throw new CHttpException('Ingen tilgang');
		return $article;
	}

	
	private function renderArticleForm($model) {
		if (isset($_POST['Article'])) {
			$model->setAttributes($_POST['Article']);
			$model->purify();
			$model->save();
			
			$this->redirect($model->getViewUrl());
			return;
		}
		
		$this->render('edit',
				array(
					'model'=> $model,
			));
	}
    
    public function getArticleModel($id) {
        $model = Article::model()->findByPk($id);
        if ($model)
            return $model;
        else
            throw new CHttpException("Artikkelen finnes ikke");
	}
}