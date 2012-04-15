<?php

class SiteController extends Controller {

	public static $innsidaLink = "https://innsida.ntnu.no/sso/?target=hybridaweb&returnargs=";

	public function actionIndex() {
		$this->forward("/newsfeed/");
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

	public function actionInnsidaLogin($data, $sign, $target, $returnUrl) {
		ob_clean();
		
		$SSOclient = new SSOclient($data, $sign, $_SERVER['REMOTE_ADDR'], $target);
		$identity = new InnsidaIdentity($SSOclient);

		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect($returnUrl);
		} else {
			throw new CHttpException("Logg inn ikke vellykket"
					.$identity->errorMessage);
		}
	}

	public function actionLogin($page) {
		$redirect = $this->getLoginRedirect($page);
		$this->redirect($redirect);
		return;
	}
	
	public function getLoginRedirect($page) {
		$returnUrl = $_SERVER['SERVER_NAME'] . "/site/innsidalogin,$page";

		//$returnUrl = ''; // Fix. Sjekker om dette fjerner redirecthelvete
		
		$redirectUrl = self::$innsidaLink . $returnUrl;

		return $redirectUrl;
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
