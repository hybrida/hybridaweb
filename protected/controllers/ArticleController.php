<?php

class ArticleController extends Controller {
	private $feedLimit = 3;
	private $offset = 0;

    public function actionView($id) {
        $article = Article::model()->findByPk($id);
		
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
	
	public function actionCreate() {
		if(!user()->checkAccess('createArticle')) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}
		
		$model = new Article;
		$this->renderArticleForm($model);		
	}
    
    public function actionEdit($id){
		if(!user()->checkAccess('updateArticle', array('id' => $id))) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}
		
		$model = $this->getArticleModel($id);
		$this->renderArticleForm($model);
    }
	
	private function renderArticleForm($model) {
		if (isset($_POST['Article'])) {
			$model->setAttributes($_POST['Article']);
			$model->save();
			
			$this->redirect($model->getViewUrl());
			return;
		}
		
		$this->render('edit',
				array(
					'model'=> $model,
			));
	}

	public function actionFeed() {
		$feedElements = $this->getFeedElements();
		$this->render("feed", array(
			'models' => $feedElements,
			'index' => $this->offset,
			'limit' => $this->feedLimit,
			'hasPublishAccess' => user()->checkAccess('createArticle'),
		));
	}
	
	private function getFeedElements($offset = 0) {
		$feed = new ArticleFeed($this->feedLimit, $offset);
		$elements = $feed->getElements();
		$this->offset = $feed->getOffset();

		return $elements;
	}
    
    public function getArticleModel($id) {
        $model = Article::model()->findByPk($id);
        if ($model)
            return $model;
        else
            throw new CHttpException("Artikkelen finnes ikke");
	}
}