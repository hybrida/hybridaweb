<?php

class ProfileController extends Controller {

	public $imageId;

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
	}

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array("index", "info", "view", "edit", "comment"),
				'users' => array('@'),
			),
			array('deny'),
		);
	}

	public function actionIndex() {
		$this->actionInfo(user()->name);
	}

	public function actionView($username) {
		$this->actionInfo($username);
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

	public function actionEdit($username) {
		$updateAccess = user()->checkAccess('updateProfile', array(
			'username' => $username,
		));
		if (!$updateAccess) {
			throw new CHttpException(403, "Du har ikke tilgang til å endre denne profilen");
		}
		$user = User::model()->find('username = ?', array($username));

		if (!$user) {
			throw new CHttpException("Brukeren finnes ikke");
		}

		if (isset($_POST['User'])) {
			$user->attributes = $_POST['User'];
			if ($user->validate()) {
				$user->purify();
				$user->save();
				$this->redirect(array('/profile/info', 'username' => $username));
			} else {
				print_r($user->errors);
				return;
			}
		}

		$fb = new Facebook();
		$this->render('edit', array(
			'fb' => $fb->authLink(),
			'model' => $user,
			'specializations' => $this->getSpecializationsList(),
			'companies' => $this->getCompaniesList(),
		));
	}

	public function getSpecializationsList() {
		$specs = Specialization::model()->findAll();
		$array = array();
		$array[null] = 'Ingen valgt';
		foreach ($specs as $spec) {
			$array[$spec->id] = $spec->name;
		}
		return $array;
	}

	public function getCompaniesList() {
		$companies = app()->db->createCommand()
				->select('companyID, companyName')
				->from('bk_company')
				->order('companyName ASC')
				->queryAll();
		$array = array();
		$array[null] = 'Ingen valgt';
		foreach ($companies as $c) {
			$array[$c['companyID']] = $c['companyName'];
		}
		return $array;
	}
}