<?php

/**
 * Description of TabNavigation
 *
 * @author marius
 */
class KnightPresentation extends CWidget {

    private $models;
 
    public function init() {
        parent::init();
        $criteria = new CDbCriteria();
        $criteria->order = "grantYear desc";
        $this->models = Knight::model()->findAll($criteria);
    }
 
    public function run() {
        $this->render('knightPresentation', array(
            'models' => $this->models,
        ));
    }

}