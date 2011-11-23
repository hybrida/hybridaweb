<?php

class SiteController extends Controller {

	public function actionIndex() {
		//$this->render('index');
		$this->render('../news/feed');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin($data=null, $sign=null, $target=null) {
		if ($data == null && $sign == null && $target == null) {
			$returnargs = Yii::app()->user->returnUrl;
			$redirect = "https://innsida.ntnu.no/sso/?target=hybridaweb&returnargs="
					. $returnargs;
			echo $redirect;
//			$this->redirect($redirect);
			return;
		}

		ob_clean();
		$identity = new InnsidaIdentity($data, $sign, $target);

		if ($identity->authenticate()) {
			Yii::app()->user->login($identity);
			$this->redirect(Yii::app()->user->returnUrl);
		} else {
			$this->render("403", array('msg' => $identity->errorMessage));
		}
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}