<?php

class SiteController extends Controller {

	private static $innsidaLink = "https://innsida.ntnu.no/sso/?target=hybridaweb&returnargs=";

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

	public function actionInnsidaLogin($data, $sign, $returnUrl) {
		ob_clean();

		$SSOclient = new SSOclient($data, $sign, $_SERVER['REMOTE_ADDR']);
		$identity = new InnsidaIdentity($SSOclient);

		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect($returnUrl);
		} else {
			throw new CHttpException(403,
					"Logg inn ikke vellykket: " . $identity->getErrorMessage());
		}
	}

	public function actionLogin($page) {
		$redirect = $this->getLoginRedirect($page);
		$this->redirect($redirect);
	}

	public function getLoginRedirect($page) {
		$innsidaLoginActionUrl = $this->createAbsoluteUrl("/site/innsidalogin"); // hybrida.no/site/innsidalogin
		$innsidaLoginActionUrl = str_replace("http://", "", $innsidaLoginActionUrl); // hybrida.no/site/innsidalogin
		$returnUrl = $innsidaLoginActionUrl ."," .$page; // returnUrl = hybrida.no/site/innsidalogin,/current_page
		// https://innsida.ntnu.no/sso/?target=hybridaweb&returnargs=hybrida.no/site/innsidalogin,/current_page
		$redirectUrl = self::$innsidaLink . $returnUrl;

		return $redirectUrl;
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect("https://innsida.ntnu.no/c/portal/logout");
	}
}
