<?php

class DefaultController extends Controller
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
            $this->render('view/companyoverview');
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