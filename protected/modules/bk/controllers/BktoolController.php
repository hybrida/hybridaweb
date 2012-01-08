<?php

class BktoolController extends Controller {

	protected $title = 'Hybrida Bedriftskomité';
        protected $lineOfStudy = 'Ingeniørvitenskap og IKT';
        protected $bkGroupId = 57;
        protected $oddRowColour = '#CCFFFF';
        protected $evenRowColour = '#FFFFFF';

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
                $data['lastUpdateInfo'] = $bkTool->getLatestUpdateTimeStampRelevantForCurrentUser();
                $data['relevantUpdatesInfo'] = $bkTool->getSumOfUpdatesRelevantForCurrentUser();
                $data['relevantUpdates'] = $bkTool->getAllUpdatesRelevantForCurrentUser();
                
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
                $data['employedGraduates'] = $bkTool->getEmployedGraduatesByCompanyId($id);
                $data['employedGraduatesSum'] = $bkTool->getSumOfEmployedGraduatesByCompanyId($id);
                $data['parentCompanyName'] = $bkTool->getParentCompanyBySubCompanyId($id);
                $data['relevantSpecializations'] = $bkTool->getRelevantSpecializationsByCompanyId($id);
                $data['timestamps'] = $bkTool->getAllCompanyTimestampsByCompanyId($id);
                $data['status'] = $bkTool->getStatusByCompanyId($id);
                $data['status'] = $bkTool->getStatusByCompanyId($id);
                $data['contactor'] = $bkTool->getContactorByCompanyId($id);
                $data['updater'] = $bkTool->getPersonWhichUpdatedLastByCompanyId($id);
                $data['adder'] = $bkTool->getPersonWhichAddedCompanyByCompanyId($id);
                $data['commentsSum'] = $bkTool->getSumOfAllCommentsByCompanyId($id);
                $data['comments'] = $bkTool->getAllCommentsByCompanyId($id);
                
                $this->render('company', $data);
        }
        
        public function actionEditcompany($id){
                $bkTool = new Bktool();
		$data = array();            
                
                $this->render('editcompany', $data);
        }
        
        public function actionAddcompany(){
                $this->render('addcompany'); 
        }

        public function actionEditgraduate($id){
                $bkTool = new Bktool();
		$data = array();
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                $data['specializationNamesSum'] = $bkTool->getSumOfAllDistinctSpecializationNames();
                $data['graduationYears'] = $bkTool->getAllSelectableGraduationYears();
                $data['graduateInfo'] = $bkTool->getGraduateInfoByUserId($id);
                
                $this->render('editgraduate', $data); 
        }
}