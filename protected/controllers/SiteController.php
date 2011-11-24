<?php

class SiteController extends Controller {

	public static $innsidaLink = "https://innsida.ntnu.no/sso/?target=hybridaweb&returnargs=";

	public function actionIndex() {
		//$this->render('index');
		$this->render('../news/feed');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		$error = Yii::app()->errorHandler->error;
		if ($error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionInnsidaLogin($data, $sign, $target) {
		ob_clean();
		$identity = new InnsidaIdentity($data, $sign, $target);

		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect(user()->returnUrl);
		} else {
			throw new CHttpException("Logg inn ikke vellykket"
					.$identity->errorMessage);
		}
	}

	public function actionLogin() {
		$redirect = $this->getLoginReturnargs();
		$this->redirect($redirect);
		return;
	}
	
	public function getLoginReturnargs() {
		$returnUrl = user()->returnUrl;
		$returnUrl = ''; // Fix. Sjekker om dette fjerner redirecthelvete
		
		$redirectUrl = self::$innsidaLink . $returnUrl;
		return $redirectUrl;
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
