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
		$allowed = array(
				'sex' => "male",
				'role' => "mod",
				'group' => 'bedkom',
				'loggedIn' => true,
		);
		
		// if ( ! GateKeeper::check($allowed)) {
		if (true) {
			$this->render("application.views.site.403",array("msg"=> "Dette gikk ikke"));
			return;
		}
		
		$this->render("index");
		
	}
	
	public function actionDummy($id,$tull) {
				$this->render("index");
	}
}

?>
