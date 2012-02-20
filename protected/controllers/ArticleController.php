<?php

class ArticleController extends Controller {

    public function actionView($id) {
        $model = Article::model()->findByPk($id);
        if ($model !== null) {
                $data = $model->getAttributes();

                $this->render("view", $data);
        }
    }
    
    public function actionCollection(){

        $article = new Article();
        $articleList['menuelements'] = $article->listArticles('wiki');      //Litt for statisk

        $aId = $articleList[0][0];

        $data = $article->getArticle($aId);

        //print_r($data);
        $this->renderPartial('menu',$articleList);
        $this->render('view',$data);
    }
	
	public function actionCreate() {
		$model = New Article;

		if (isset($_POST['Article'])) {
			echo "<pre>";
			print_r($_POST);
			
			$model->attributes = $_POST['Article'];
			$model->save();
			print_r($model->attributes);
			echo "</pre>";
		}
		
		if(isset($content) && isset($title)) {
			$model->setAttribute('content', $content);
			
			
			
			return;
		}
		$this->render('edit',
				array(
					'model'=> $model,
				));
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