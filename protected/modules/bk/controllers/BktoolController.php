<?php

class BktoolController extends Controller {

	protected $title = 'Hybrida Bedriftskomité';
        protected $lineOfStudy = 'Ingeniørvitenskap og IKT';
        protected $bkGroupId = 57;

	public function actionIndex() {
		$this->render('index');
	}

	public function actionCalendar() {
		$this->render('calendar');
	}

	public function actionUpdates() {
                $bkTool = new Bktool();
		$data = array();
                $data['loginInfo'] = $bkTool->getLastLoginCurrentUser();
                
		$this->render('updates', $data);
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
		$data['graduationYears'] = $bkTool->getAllGraduationYears();
                $data['graduatesByYear'] = $bkTool->getNumberOfGraduatesGroupedByYear();
                $data['employeesByYear'] = $bkTool->getNumberOfEmployedGraduatesGroupedByYear();
		$data['graduatesSum'] = $bkTool->getSumOfAllGraduates();
		$data['employingCompanies'] = $bkTool->getAllEmployingCompanies();
		$data['employeesSum'] = $bkTool->getSumOfAllEmployedGraduates();
		$data['graduates'] = $bkTool->getAllGraduates();

		$this->render('graduates', $data);
	}

	public function actionCompanyDistribution() {
                $bkTool = new Bktool();
		$data = array();
                $data['contactingMembers'] = $bkTool->getMembersByContactingStatus('Blir kontaktet');
                $data['contactedCompanies'] = $bkTool->getCompaniesByContactingStatus('Blir kontaktet');
               
		$this->render('companydistribution', $data);
	}

	public function actionPresentations() {
		$this->render('presentations');
	}

        public function actionGraduationyear($id) {
                $bkTool = new Bktool();
		$data = array();
		$data['graduationYears'] = $bkTool->getAllGraduationYears();
                $data['graduatesByYear'] = $bkTool->getNumberOfGraduatesGroupedByYear();
                $data['employeesByYear'] = $bkTool->getNumberOfEmployedGraduatesGroupedByYear();
		$data['graduatesSum'] = $bkTool->getSumOfAllGraduates();
		$data['employingCompanies'] = $bkTool->getAllEmployingCompanies();
		$data['employeesSum'] = $bkTool->getSumOfAllEmployedGraduates();
		$data['employingCompaniesByYear'] = $bkTool->getEmployingCompaniesByYear($id);
                $data['employeesSumByYear'] = $bkTool->getSumOfEmployedGraduatesByYear($id);
                $data['graduatelistByYear'] = $bkTool->getGraduatesByYear($id);
                $data['graduatesSumByYear'] = $bkTool->getSumOfGraduatesByYear($id);
                $data['graduationyear'] = $id;
                
		$this->render('graduationyear', $data);
	}
        
        public function actionCompany($id){
                $bkTool = new Bktool();
		$data = array();
                $data['companyId'] = $id;
                $data['companyContactInfo'] = $bkTool->getCompanyContactInfoById($id);
                
                $this->render('company', $data);
        }
}