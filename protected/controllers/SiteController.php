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

	public function actionInnsidaLogin($data, $sign, $target, $returnUrl) {
		ob_clean();

		$SSOclient = new SSOclient($data, $sign, $_SERVER['REMOTE_ADDR'], $target);
		$identity = new InnsidaIdentity($SSOclient);

		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect($returnUrl);
		} else {
			throw new CHttpException(403,
					"Logg inn ikke vellykket" . $identity->errorMessage);
		}
	}

	public function actionLogin($page) {
		$redirect = $this->getLoginRedirect($page);
		$this->redirect($redirect);
	}

	public function getLoginRedirect($page) {
		$innsidaLoginActionUrl = $this->createAbsoluteUrl("/site/innsidalogin");
		$innsidaLoginActionUrl = str_replace("http://", "", $innsidaLoginActionUrl);
		$returnUrl = $innsidaLoginActionUrl ."," .$page;

		$redirectUrl = self::$innsidaLink . $returnUrl;

		return $redirectUrl;
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
