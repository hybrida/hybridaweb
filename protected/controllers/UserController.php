<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberController
 *
 * @author sigurd
 */
class UserController extends Controller {
	
	public function actionIndex() {
		// FIXME gammel mysql
		$this->render("all");
	}
	
	public function actionView($id=null) {
		if ($id === null) {
			if (Yii::app()->user->isGuest) {
				$id = -1; //Gjest
			} else {
				$id = Yii::app()->user->id;
			}
		}
		//FIXME gammel mysql
		$this->render("view",array("id" => $id));
	}
	//put your code here
}

?>
