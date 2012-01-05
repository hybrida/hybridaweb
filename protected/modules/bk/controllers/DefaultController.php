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
}