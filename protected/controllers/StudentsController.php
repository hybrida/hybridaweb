<?php

class StudentsController extends Controller {
	
	public function actionIndex() {
		$this->actionView(date('Y') + 4);
	}

	public function actionView($id) {
		$profile = new Profile();
		$data['users'] = $profile->displayMembers($id);
		$data['now'] = date("Y");
		$data['graduationYear'] = $id;
		$this->render('view', $data);
	}

}