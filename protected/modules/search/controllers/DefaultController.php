<?php

class DefaultController extends Controller {

    public function actionIndex() {
        //$this->render('index');

        if (strlen($_GET['q']) < 1) {
            die("");
        }
        $q = $_GET['q'];

        $search = new Search();

        $split = '~%~';

        $result['users'] = $search->searchUsers($q);
        $result['newsList'] = $search->searchNews($q);
        $result['url'] = Yii::app()->baseUrl . "/profile/";
        $result['split'] = $split;

        $this->renderPartial('search', $result);
    }

}