<?php

class SiteController extends Controller {

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array(
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array(
						'class' => 'CViewAction',
				),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$this->render('index');
	}
    
    public function actionFaq() {
        $this->render('faq');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$user = $_REQUEST['user'];
		$pass = $_REQUEST['pass'];
		$identity = new InnsidaIdentity($user, $pass);

		if ($identity->authenticate()) {
			Yii::app()->user->login($identity);
			$this->render("login");
		} else {
			$this->render("403", array('msg' => $identity->errorMessage()));
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionDebug() {
		if (Yii::app()->user->isGuest) {
			$this->render("403", array("msg" => "Du må være logget inn!"));
		} else {
			
			$user = Yii::app()->user;
			
			$data = array();
			$data['username'] = $user->name;
			$data['id'] = $user->id;
			$data['access'] = $user->access;
			
			$this->render("debug",$data);
		}
	}

}