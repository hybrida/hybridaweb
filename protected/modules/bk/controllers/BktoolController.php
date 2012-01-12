<?php

class BktoolController extends Controller {

	protected $title = 'Hybrida Bedriftskomité';
        protected $lineOfStudy = 'Ingeniørvitenskap og IKT';
        protected $organisationName = 'Hybrida';
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
        
        public function actionDeleteupdateform(){
               $bkForms = new Bkforms();
               
               if(isset($_POST['selectedupdates'])){
                   if(in_array('deleteall', $_POST['selectedupdates'])){
                        $bkForms->deleteAllUpdatesRelevantToCurrentUser();
                        $this->actionUpdates();
                   }
                   else{
                        foreach ($_POST['selectedupdates'] as $updateId) :
                            $bkForms->deleteUpdateByUpdateId($updateId);
                        endforeach;
                        $this->actionUpdates();
                   } 
               }
               else{
                   $this->actionUpdates();
               }
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
                $data['contactor'] = $bkTool->getContactorByCompanyId($id);
                $data['updater'] = $bkTool->getPersonWhichUpdatedLastByCompanyId($id);
                $data['adder'] = $bkTool->getPersonWhichAddedCompanyByCompanyId($id);
                $data['commentsSum'] = $bkTool->getSumOfAllCommentsByCompanyId($id);
                $data['comments'] = $bkTool->getAllCommentsByCompanyId($id);
                
                $this->render('company', $data);
        }
        
        public function actionAddcommentform($id){
                $bkForms = new Bkforms();
		$data = array();
                
                if($bkForms->isInputFieldEmpty($_POST['comment'])){
                    $this->actionCompany($id);
                }
                else{
                    $bkForms->addCompanyComment($_POST['comment'], $id);
                    
                    $bkTool = new Bktool();
                    $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId);
                    foreach ($data['members'] as $member) :
                        $bkForms->addCompanyCommentUpdate($id, $member['id']);
                    endforeach;
                    
                    $this->actionCompany($id);
                }
        }


        public function actionEditcompany($id){
                $bkTool = new Bktool();
		$data = array();
                $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId);
                $data['membersSum'] = $bkTool->getSumOfAllActiveMembersByGroupId($this->bkGroupId);
                $data['companyContactInfo'] = $bkTool->getCompanyContactInfoById($id);
                $data['parentCompanyName'] = $bkTool->getParentCompanyBySubCompanyId($id);
                $data['relevantSpecializations'] = $bkTool->getRelevantSpecializationsByCompanyId($id);
                $data['status'] = $bkTool->getStatusByCompanyId($id);
                $data['contactor'] = $bkTool->getContactorByCompanyId($id);
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                
                $this->render('editcompany', $data);
        }
        
        public function actionEditcompanyform($id){
                
                $this->actionCompany($id);
        }
        
        public function actionAddcompany($errordata=null){
                $bkTool = new Bktool();
		$data = array();
                $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId);
                $data['membersSum'] = $bkTool->getSumOfAllActiveMembersByGroupId($this->bkGroupId);
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                $data['errordata'] = $errordata;
                
                $this->render('addcompany', $data); 
        }
        
        public function actionAddcompanyform(){
                $bkForms = new Bkforms();
                $bkTool = new Bktool();
		$errordata = array();
                $phonenumber;
                $postnumber;
                $parentCompanyId;
                $companyId;
                
                if($bkForms->isInputFieldEmpty($_POST['addedcompany'])){
                    $errordata['error'] = true;
                    $errordata['addedcompanyerror'] = 'Bedriftsnavnet mangler';
                }
                else{
                    if($bkForms->isCompanyInDatabase($_POST['addedcompany'])){
                        $errordata['error'] = true;
                        $errordata['addedcompanyerror'] = 'Bedriften finnes allerede i databasen';
                    }
                }
                
                if(!$bkForms->isInputFieldEmpty($_POST['phonenumber'])){
                    (int) $phonenumber = intval($_POST['phonenumber']);
                    if((int) $phonenumber <= (int) 0){
                        $errordata['error'] = true;
                        $errordata['phonenumbererror'] = 'Ugyldig telefonnummer';
                    }
                }
                
                if(!$bkForms->isInputFieldEmpty($_POST['postnumber'])){
                    (int) $postnumber = intval($_POST['postnumber']);
                    if((int) $postnumber <= (int) 0){
                        $errordata['error'] = true;
                        $errordata['postnumbererror'] = 'Ugyldig postnummer';
                    }
                }
                
                if(!$bkForms->isInputFieldEmpty($_POST['parentcompany'])){
                    if($bkForms->isCompanyInDatabase($_POST['parentcompany'])){
                        
                        $data['parentcompany'] = $bkTool->getCompanyIdByCompanyName($_POST['parentcompany']);
                        
                        foreach ($data['parentcompany'] as $company) :
                            $parentCompanyId = $company['companyID'];
                        endforeach;
                    }
                    else{
                        $errordata['error'] = true;
                        $errordata['parentcompanyerror'] = 'Bedriften finnes ikke i databasen';
                    }
                }
                
                if(isset($errordata['error'])){
                    $this->actionAddcompany($errordata);
                }
                else {
                    $bkForms->insertCompanyInformation($_POST['addedcompany'], $_POST['mail'], $_POST['phonenumber'], $_POST['adress'], 
                                $_POST['postbox'], $_POST['postnumber'], $_POST['postplace'], $_POST['homepage'], $parentCompanyId, $_POST['status']);
                    
                    
                    $data['thiscompany'] = $bkTool->getCompanyIdByCompanyName($_POST['addedcompany']);
                    
                    foreach ($data['thiscompany'] as $company) :
                        $companyId = $company['companyID'];
                    endforeach;
                    
                    if(isset($_POST['contactor'])){
                        $bkForms->updateCompanyContactor($companyId, $_POST['contactor']);
                    }
                    
                    if(isset($_POST['specializations'])){
                        foreach ($_POST['specializations'] as $specializationId) :
                            $bkForms->insertCompanySpecialization($companyId, $specializationId);
                        endforeach;
                    }
                    
                    $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId);
                    foreach ($data['members'] as $member) :
                        $bkForms->addCompanyInsertionUpdate($member['id'], $companyId);
                        $bkForms->addCompanyStatusUpdate($member['id'], $companyId);
                        
                        if(!$bkForms->isInputFieldEmpty($_POST['mail'])){
                            $bkForms->addCompanyMailUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['phonenumber'])){
                            $bkForms->addCompanyPhonenumberUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['adress'])){
                            $bkForms->addCompanyAdressUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['postbox'])){
                            $bkForms->addCompanyPostboxUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['postnumber'])){
                            $bkForms->addCompanyPostnumberUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['postplace'])){
                            $bkForms->addCompanyPostplaceUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['homepage'])){
                            $bkForms->addCompanyHomepageUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['parentcompany'])){
                            $bkForms->addCompanyParentCompanyUpdate($member['id'], $companyId);
                        }
                        if(isset($_POST['contactor'])){
                            $bkForms->addCompanyContactorUpdate($member['id'], $companyId);
                        }
                        if(isset($_POST['specializations'])){
                            $bkForms->addCompanySpecializationUpdate($$member['id'], $companyId);
                        }
                    endforeach;
                    
                    $this->actionCompanyOverview();
                }
        }

        public function actionEditgraduate($id, $errordata=null){

                $bkTool = new Bktool();
		$data = array();
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                $data['specializationNamesSum'] = $bkTool->getSumOfAllDistinctSpecializationNames();
                $data['graduationYears'] = $bkTool->getAllSelectableGraduationYears();
                $data['graduateInfo'] = $bkTool->getGraduateInfoByUserId($id);
                $data['errordata'] = $errordata;
                
                $this->render('editgraduate', $data); 
        }
        
        public function actionEditgraduateform($id){
                $bkForms = new Bkforms();
		$errordata = array();
                
                if(!$bkForms->isInputFieldEmpty($_POST['workcompany'])){
                    if(!$bkForms->isCompanyInDatabase($_POST['workcompany'])){
                        $errordata['error'] = true;
                        $errordata['workcompanyerror'] = 'Bedriften finnes ikke i databasen';
                    }
                }
                
                if(isset($errordata['error'])){ 
                    $this->actionEditgraduate($id, $errordata);
                }
                else{
                    $bkForms->updateGraduateAltEmail($id, $_POST['altemail']);
                    $bkForms->updateGraduateSpecialization($id, $_POST['specialization']);
                    $bkForms->updateGraduateWorkDescription($id, $_POST['workdescription']);
                    $bkForms->updateGraduateWorkPlace($id, $_POST['workplace']);
                    $bkForms->updateGraduateGraduationYear($id, $_POST['graduationyear']);
                    
                    if($bkForms->hasGraduateWorkCompanyChanged($id, $_POST['workcompany'])){
                        $bkForms->updateGraduateWorkCompany($id, $_POST['workcompany']);
                        
                        $bkTool = new Bktool();
                        $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId);
                        foreach ($data['members'] as $member) :
                            $bkForms->addCompanyGraduateUpdate($member['id'], $_POST['workcompany']);
                        endforeach;
                    }
                    
                    $this->actionGraduates();
                }
        }
}