<?php

Yii::import("bk.models.Bktool");

class GraduateController extends Controller {

    protected $pageHeader = 'Alumni';
    protected $lineOfStudy = 'Ingeniørvitenskap og IKT';

    public function actionIndex() {
        $this->publishCss();
        $this->setPageTitle($this->pageHeader);

        $bkTool = new Bktool();
        $data = array();

        $data['graduationYears'] = $bkTool->getAllGraduationYears();
        $data['graduatesByYear'] = $bkTool->getNumberOfGraduatesGroupedByYear();
        $data['employeesByYear'] = $bkTool->getNumberOfEmployedGraduatesGroupedByYear();
        $data['graduatesSum'] = $bkTool->getSumOfAllGraduates();
        $data['employingCompanies'] = $bkTool->getAllEmployingCompanies();
        $data['employeesSum'] = $bkTool->getSumOfAllEmployedGraduates();

        $this->render('index', $data);
    }
    
    public function actionGraduationyear($id){
        $this->publishCss();
        $this->setPageTitle($this->pageHeader);
        
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
        $data['graduatelistByYear'] = $bkTool->getGraduatesByYear($id, 'firstName', 'ASC');
        $data['graduatesSumByYear'] = $bkTool->getSumOfGraduatesByYear($id);
        $data['graduationyear'] = $id;
        
        $this->render('graduationyear', $data);
    }

    private function publishCss() {
        $bkAssetsDir = Yii::getPathOfAlias("bk.assets");
        $url = $bkAssetsDir . "/css/";
        $cs = Yii::app()->getClientScript();
        $am = Yii::app()->getAssetManager();
        $cs->registerCssFile($am->publish($url . 'alumni-style.css'));
    }

}