<?php

class SiteController extends Controller {

	public static $innsidaLink = "https://innsida.ntnu.no/sso/?target=hybridaweb&returnargs=";

	public function actionIndex() {
		$this->forward("news/feed");
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
		
		$SSOclient = new SSOclient($data, $sign, $_SERVER['REMOTE_ADDR'], $target);
		$identity = new InnsidaIdentity($SSOclient);

		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect(user()->returnUrl);
		} else {
			throw new CHttpException("Logg inn ikke vellykket"
					.$identity->errorMessage);
		}
	}

	public function actionLogin() {
		$redirect = $this->getLoginRedirect();
		$this->redirect($redirect);
		return;
	}
	
	public function getLoginRedirect() {
		$returnUrl = $_SERVER['SERVER_NAME'] . "/site/innsidalogin";

		//$returnUrl = ''; // Fix. Sjekker om dette fjerner redirecthelvete
		
		$redirectUrl = self::$innsidaLink . $returnUrl;

		return $redirectUrl;
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
