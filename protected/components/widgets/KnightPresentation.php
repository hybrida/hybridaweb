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
                $this->models = Knight::model()->findAll();
	}
	
	public function run() {
		$this->render('knightPresentation', array(
                    'models' => $this->models,
                ));
	}

}