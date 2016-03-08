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

	public function actionInnsidaLogin($data, $sign, $returnargs) {
		if ($_SERVER['HTTP_HOST'] == "login.hybrida.no") {
			if (strlen($returnargs) > 1 && $returnargs[strlen($returnargs) - 1] == ',') {
				header('Location: http://beta.hybrida.no/verifylogin?data=' . urlencode($data . '&sign=' . $sign .
					'&returnargs=' . $returnargs));
				die();
			}
			$hybridaUrl = "http://hybrida.no" .
				$this->createUrl("site/innsidalogin", array(
					'data' => $data,
					'sign' => $sign,
					'returnargs' => $returnargs));
			$this->redirect($hybridaUrl);
			return;
		}

		$SSOclient = new SSOclient($data, $sign, $_SERVER['REMOTE_ADDR']);
		$identity = new InnsidaIdentity($SSOclient);

		if ($identity->authenticate()) {
			user()->login($identity);
			$returnUrl = "http://hybrida.no" . $returnargs;
			$this->redirect($returnUrl);
		} else {
			throw new CHttpException(403,
					"Logg inn ikke vellykket: " . $identity->getErrorMessage());
		}
	}

	public function actionLogin($page) {
		$redirect = self::$innsidaLink . $page;
		$this->redirect($redirect);
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect("https://innsida.ntnu.no/c/portal/logout");
	}
}
