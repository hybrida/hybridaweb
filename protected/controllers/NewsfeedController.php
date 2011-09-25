<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsfeedController
 *
 * @author sigurd
 */
class NewsfeedController extends Controller {
	
	public function actionIndex() {
		$this->render("index");
		
	}
	
	public function actionDummy($id,$tull) {
				$this->render("index");
	}
}

?>
