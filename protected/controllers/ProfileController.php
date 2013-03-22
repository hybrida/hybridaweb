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
			array('allow',
				'actions' => array('changeMember'),
				'roles' => array('admin'),
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
			throw new CHttpException(404,
					"Brukeren finnes ikke");
		}
		return $user;
	}

	public function actionComment($username) {
		$user = $this->getUserOrThrowException($username);
		$this->render('comment', array(
			'user' => $user,
		));
	}

	private function hasUpdateProfileAccess($username) {
		return user()->checkAccess('updateProfile', array(
					'username' => $username));
	}

	public function actionEdit($username) {
		if (!$this->hasUpdateProfileAccess($username)) {
			throw new CHttpException(403, "Du har ikke tilgang til å endre denne profilen");
		}
		$user = $this->getUserOrThrowException($username);
		$form = new ProfileForm($user);
		$this->saveFormAndRedirectIfPostRequest($form);
		$this->render("edit", array(
			'user' => $user,
			'facebookUser' => $form->getFacebookUserModel(),
			'model' => $form,
			'hasConnectedToFacebook' => $form->getFacebookUserModel() !== null,
			'specializations' => Html::getSpecializationsDropDownArray(),
			'companies' => Html::getCompaniesDropDownArray(),
		));
	}

	public function saveFormAndRedirectIfPostRequest(ProfileForm $form) {
		if (!isset($_POST['ProfileForm']))	return;
		$form->setAttributes($_POST['ProfileForm']);
		$form->save();
		$this->redirectToProfile($form->getUserModel());
	}

	public function redirectToProfile(User $user) {
		$url = $this->createUrl("/profile/info", array(
			'username' => $user->username,
				));
		$this->redirect($url);
	}

	public function actionChangeMember($username="") {
		$msg = '';
		$user = User::findByUsername($username);
		if (Yii::app()->request->isPostRequest && $user != null) {
			$isMember = isset($_POST['isMember']);
			$isNotMember = isset($_POST['isNotMember']);
			if ($isMember == $isNotMember){
				throw new CHttpException(400, "Kan ikke være både medlem og".
						" ikke-medlem");
			}
			$isMemberText = $isMember ? "<span class='member'>medlem</span>" :
				"<span class='notmember'>ikke medlem</span>";
			if ($isMember) {
				$user->member = 'true';

			} else {
				$user->member = 'false';
			}
			if (!$user->save()){
				throw new CHttpException(500, "Det ble ikke lagret at ".
						$user->fullName." har status " . $isMemberText);
			}
			$msg = $user->fullName . " har nå status: " . $isMemberText;
		}
		$this->render('changeMember', array(
			'user' => $user,
			'message' => $msg,
		));
	}

}