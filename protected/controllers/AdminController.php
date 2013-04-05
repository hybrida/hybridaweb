<?php

class AdminController extends Controller {
    public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("news", "articles"),
				'roles' => array('editor'),
			),
			array('deny'),
		);
	}

    public function actionNews() {
        $news = News::model()->findAll(
                array(
                    'order' => 'weight DESC, timestamp DESC',
                    'condition' => 'status!=:status',
                    'params' => array(
                        ':status'=>Status::DELETED)
                    )
                );
        $data['news'] = $news;

        $this->render('news', $data);
    }

    public function actionArticles() {
        $articles = Article::model()->findAll(array('order'=>'parentId, id'));
        $data['articles'] = $articles;

        $this->render('articles', $data);
    }
}
