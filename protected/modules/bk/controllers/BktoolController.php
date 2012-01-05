<?php

class BktoolController extends Controller {

	protected $title = 'Hybrida Bedriftskomité';

	public function actionIndex() {
		$this->render('index');
	}

	public function actionCalendar() {
		$this->render('calendar');
	}

	public function actionUpdates() {
		$this->render('updates');
	}

	public function actionCompanyOverview() {
		$bkTool = new Bktool();
		$data = array();
		$data['companies'] = $bkTool->getCompanyOverview();
		$data['statistics'] = $bkTool->getCompanyOverviewStatistics();

		$this->render('companyoverview', $data);
	}

	public function actionGraduates() {
		$bkTool = new Bktool();
		$data = array();
		$data['years'] = $bkTool->getAllGraduationYears();
		$data['yearsum'] = $bkTool->getAllGraduationYearsSum();
		$data['companies'] = $bkTool->getAllGraduationCompanies();
		$data['companysum'] = $bkTool->getAllGraduationCompaniesSum();
		$data['graduates'] = $bkTool->getAllGraduates();

		$this->render('graduates', $data);
	}

	public function actionCompanyDistribution() {
		$this->render('companydistribution');
	}

	public function actionPresentations() {
		$this->render('presentations');
	}

}