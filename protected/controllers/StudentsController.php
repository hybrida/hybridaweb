<?php

class StudentsController extends Controller {
	
	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'users' => array('@'),
			),
			array('deny'),
		);
	}
	
	public function actionIndex() {
		$this->actionView(YearConverter::getFreshmanGraduationYear());
	}

	public function actionView($id) {
		$profile = new Profile();
		$this->render('view', array(
			'users' => $profile->displayMembers($id),
			'graduationYear' => $id,
		));
	}

}