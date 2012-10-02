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
				'roles' => array('admin'),
			),
			array('deny'),
		);
	}
    
    public function actionNews() {
        $news = News::model()->findAll('status!=:status', array(':status'=>Status::DELETED));
        $data['news'] = $news;
        
        $this->render('news', $data);
    }
    
    public function actionArticles() {
        
    }
}

?>
