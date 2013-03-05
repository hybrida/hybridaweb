<?php

class NewsfeedController extends Controller {
	public function actionIndex() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("`status` = " . Status::PUBLISHED);
        $criteria->order = "`weight` DESC, `timestamp` DESC";
        $total = News::model()->count('`status`= ' . Status::PUBLISHED);

        $pages = new CPagination($total);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $news = News::model()->findAll($criteria);
        
        $this->render('feed', array(
            'news' => $news,
            'pages' => $pages,
            'hasPublishAccess' => user()->checkAccess('createNews'),
        ));
	}
}
