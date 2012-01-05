<?php

class BkToolController extends Controller
{
        protected $title = 'Hybrida Bedriftskomité';
        
	public function actionIndex()
	{
            $this->render('index');
	}
        
        public function actionCalendar()
	{
            $this->render('view/calendar');
	}
        
        public function actionUpdates()
	{
            $this->render('view/updates');
	}
        
        public function actionCompanyOverview()
	{
            $bkTool = new Bktool();
            $data = array();
            $data['companies'] = $bkTool->getCompanyOverview();
            $data['statistics'] = $bkTool->getCompanyOverviewStatistics();
            
            $this->render('view/companyoverview', $data);
	}
        
        public function actionGraduates()
	{
            $bkTool = new Bktool();
            $data = array();
            $data['years'] = $bkTool->getAllGraduationYears();
            $data['yearsum'] = $bkTool->getAllGraduationYearsSum();
            $data['companies'] = $bkTool->getAllGraduationCompanies();
            $data['companysum'] = $bkTool->getAllGraduationCompaniesSum();
            $data['graduates'] = $bkTool->getAllGraduates();
            
            $this->render('view/graduates', $data);
	}
        
        public function actionCompanyDistribution()
	{
            $this->render('view/companydistribution');
	}
        
        public function actionPresentations()
	{
            $this->render('view/presentations');
	}
}