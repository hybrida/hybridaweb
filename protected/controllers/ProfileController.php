<?php

class ProfileController extends Controller {

	public $imageId;

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("index", "info", "edit", "comment"),
				'users' => array('@'),
			),
			array('deny'),
		);
	}

	public function actionIndex() {
		$this->actionInfo(user()->name);
	}

	public function actionInfo($username) {
		$user = $this->getUserOrThrowException($username);
		$this->render('info', array(
			'user' => $user,
		));
	}

	private function getUserOrThrowException($username) {
		$user = User::model()->find('username = :username', array(
			':username' => $username,
				));
		if (!$user) {
			throw new CHttpException("Brukeren finnes ikke",
					"Brukeren du søkte etter finnes ikke");
		}
		return $user;
	}

	public function actionComment($username) {
		$user = $this->getUserOrThrowException($username);
		$this->render('comment', array(
			'user' => $user,
		));
	}

	public function actionEdit() {
		$fb = new Facebook();
		$data['fb'] = $fb->authLink();

		$this->render('edit', $data);
	}

}