<?php

class FAQController extends Controller{
    //put your code here
    public function actionIndex(){
        
        $article = new Article();
        $data['articles'] = $article->listArticles('wiki');
        //print_r($data);
        $this->render('view',$data);
    }
}
?>
