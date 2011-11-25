<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LocalLogin
 *
 * @author sigurd
 */
class DevController extends CController {

	public function actionLogin($id) {
		$identity = new DefaultIdentity($id);
		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect(user()->returnUrl);
		}
	}

}

?>
