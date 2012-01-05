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
            $bkTool = new BkTool();
            $data = array();
            $data['companies'] = $bkTool->getCompanyOverview();
            
            $this->render('view/companyoverview', $data);
	}
        
        public function actionGraduates()
	{
            $this->render('view/graduates');
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