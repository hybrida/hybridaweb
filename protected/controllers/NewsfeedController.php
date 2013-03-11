<?php

class NewsfeedController extends Controller {
    private $criteria;
    private $total;
    private $pages;
    private $news;
    
	public function actionIndex() {
        $this->setCriteria();
        $this->total = News::model()->count('`status`= ' . Status::PUBLISHED);
        $this->setPages();
        $this->setNewsWithPermissionCheck();
        
        $this->render('feed', array(
            'news' => $this->news,
            'pages' => $this->pages,
            'hasPublishAccess' => user()->checkAccess('createNews'),
        ));
	}
    
    private function setCriteria() {
        $this->criteria = new CDbCriteria;
        $this->criteria->addCondition("`status` = " . Status::PUBLISHED);
        $this->criteria->order = "`weight` DESC, `timestamp` DESC";
    }
    
    private function setPages() {
        $this->pages = new CPagination($this->total);
        $this->pages->pageSize = 10;
        $this->pages->applyLimit($this->criteria);
    }
    
    private function setNewsWithPermissionCheck() {
        $newsUnchecked = News::model()->findAll($this->criteria);
        $newsWithAccess = array();
        
        foreach ($newsUnchecked as $newsItem) {
            if (app()->gatekeeper->hasPostAccess('news', $newsItem->id)) {
                array_push($newsWithAccess, $newsItem);
            }
            else {
                $this->total--;
            }
        }
        $this->news = $newsWithAccess;
    }
}