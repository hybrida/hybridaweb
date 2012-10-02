<?php

class AdminController extends Controller {
    public function actionNews() {
        $news = News::model()->findAll('status!=:status', array(':status'=>Status::DELETED));
        $data['news'] = $news;
        
        $this->render('news', $data);
    }
    
    public function actionArticles() {
        
    }
}

?>
