<?php

class BktoolController extends Controller {

	protected $title = 'Hybrida Bedriftskomité';
        protected $lineOfStudy = 'Ingeniørvitenskap og IKT';
        protected $organisationName = 'Hybrida';
        protected $bkGroupId = 57;
        protected $industryAssociation = 'I&IKT-ringen';
        protected $foundingYear = 2003;
        
        public function getNumberOfRelevantUpdatesAsString(){
            $bkTool = new Bktool();
            $data['relevantUpdatesInfo'] = $bkTool->getSumOfUpdatesRelevantForCurrentUser();
            
            $sum = 0;
            
            foreach ($data['relevantUpdatesInfo'] as $info) {
                $sum = $info['sum'];
            }
            if($sum == 0){
                return '';
            }
            else{
                return '('.$sum.')';
            }
        }
        
        public function getAllYearsSinceFounding(){
            $year = date('Y');
            $years = array();
            
            while($year >= $this->foundingYear){
                array_push($years, $year);
                $year--;
            }
            return $years;
        }

	public function actionIndex() {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
                
                if(!isset($_GET['orderby'])){
                    $_GET['orderby'] = 'firstName';
                }
                if(!isset($_GET['order'])){
                    $_GET['order'] = 'DESC';
                } 
                
                switch($_GET['orderby']){
                    case 'comission':
                        $_SESSION['orderby'] = 'comission';
                        break;
                    case 'firstName':
                        $_SESSION['orderby'] = 'firstName';
                        break;
                    case 'phoneNumber':
                        $_SESSION['orderby'] = 'phoneNumber';
                        break;
                    case 'username':
                        $_SESSION['orderby'] = 'username';
                        break;
                    case 'lastLogin':
                        $_SESSION['orderby'] = 'lastLogin';
                        break;
                    default:
                        $_SESSION['orderby'] = 'firstName';
                        break;
                }
                switch($_GET['order']){
                    case 'ASC':
                        $_SESSION['order'] = 'DESC';
                        break;
                    case 'DESC':
                        $_SESSION['order'] = 'ASC';
                        break;
                    default:
                        $_SESSION['order'] = 'DESC';
                        break;
                }
                
                $bkTool = new Bktool();
		$data = array();
                $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, $_SESSION['orderby'], $_SESSION['order']);
                $data['membersSum'] = $bkTool->getSumOfAllActiveMembersByGroupId($this->bkGroupId);
                $data['formerMembers'] = $bkTool->getAllFormerMembersByGroupId($this->bkGroupId);
                
		$this->render('index', $data);
	}

	public function actionCalendar() {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
		$this->render('calendar');
	}

	public function actionUpdates() {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
                $bkTool = new Bktool();
		$data = array();
                
                if(!isset($_GET['orderby'])){
                    $_GET['orderby'] = 'dateAdded';
                }
                if(!isset($_GET['order'])){
                    $_GET['order'] = 'ASC';
                } 
                
                switch($_GET['orderby']){
                    case 'dateAdded':
                        $_SESSION['orderby'] = 'dateAdded';
                        break;
                    case 'firstName':
                        $_SESSION['orderby'] = 'firstName';
                        break;
                    case 'companyName':
                        $_SESSION['orderby'] = 'companyName';
                        break;
                    case 'description':
                        $_SESSION['orderby'] = 'description';
                        break;
                    default:
                        $_SESSION['orderby'] = 'dateAdded';
                        break;
                }
                switch($_GET['order']){
                    case 'ASC':
                        $_SESSION['order'] = 'DESC';
                        break;
                    case 'DESC':
                        $_SESSION['order'] = 'ASC';
                        break;
                    default:
                        $_SESSION['order'] = 'ASC';
                        break;
                }
                
                $data['loginInfo'] = $bkTool->getLastLoginCurrentUser();
                $data['lastUpdateInfo'] = $bkTool->getLatestUpdateTimeStampRelevantForCurrentUser();
                $data['relevantUpdatesInfo'] = $bkTool->getSumOfUpdatesRelevantForCurrentUser();
                $data['relevantUpdates'] = $bkTool->getAllUpdatesRelevantForCurrentUser($_SESSION['orderby'], $_SESSION['order']);
                
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
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
		$bkTool = new Bktool();
		$data = array();
                
                if(!isset($_GET['orderby'])){
                    $_GET['orderby'] = 'companyName';
                }
                if(!isset($_GET['order'])){
                    $_GET['order'] = 'DESC';
                } 
                
                switch($_GET['orderby']){
                    case 'status':
                        $_SESSION['orderby'] = 'status';
                        break;
                    case 'firstName':
                        $_SESSION['orderby'] = 'firstName';
                        break;
                    case 'dateUpdated':
                        $_SESSION['orderby'] = 'dateUpdated';
                        break;
                    default:
                        $_SESSION['orderby'] = 'companyName';
                        break;
                }
                switch($_GET['order']){
                    case 'ASC':
                        $_SESSION['order'] = 'DESC';
                        break;
                    case 'DESC':
                        $_SESSION['order'] = 'ASC';
                        break;
                    default:
                        $_SESSION['order'] = 'DESC';
                        break;
                }

		$data['companies'] = $bkTool->getCompanyOverview($_SESSION['orderby'], $_SESSION['order']);
		$data['statistics'] = $bkTool->getCompanyOverviewStatistics();

		$this->render('companyoverview', $data);
	}

	public function actionGraduates() {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
		$bkTool = new Bktool();
		$data = array();
                
                if(!isset($_GET['orderby'])){
                    $_GET['orderby'] = 'firstName';
                }
                if(!isset($_GET['order'])){
                    $_GET['order'] = 'DESC';
                } 
                
                switch($_GET['orderby']){
                    case 'graduationYear':
                        $_SESSION['orderby'] = 'graduationYear';
                        break;
                    case 'workPlace':
                        $_SESSION['orderby'] = 'workPlace';
                        break;
                    case 'companyName':
                        $_SESSION['orderby'] = 'companyName';
                        break;
                    default:
                        $_SESSION['orderby'] = 'firstName';
                        break;
                }
                switch($_GET['order']){
                    case 'ASC':
                        $_SESSION['order'] = 'DESC';
                        break;
                    case 'DESC':
                        $_SESSION['order'] = 'ASC';
                        break;
                    default:
                        $_SESSION['order'] = 'DESC';
                        break;
                }
                
                
		$data['graduationYears'] = $bkTool->getAllGraduationYears();
                $data['graduatesByYear'] = $bkTool->getNumberOfGraduatesGroupedByYear();
                $data['employeesByYear'] = $bkTool->getNumberOfEmployedGraduatesGroupedByYear();
		$data['graduatesSum'] = $bkTool->getSumOfAllGraduates();
		$data['employingCompanies'] = $bkTool->getAllEmployingCompanies();
		$data['employeesSum'] = $bkTool->getSumOfAllEmployedGraduates();
		$data['graduates'] = $bkTool->getAllGraduates($_SESSION['orderby'], $_SESSION['order']);

		$this->render('graduates', $data);
	}

	public function actionCompanyDistribution() {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
                $bkTool = new Bktool();
		$data = array();
                $data['contactingMembers'] = $bkTool->getMembersByContactingStatus('Blir kontaktet');
                $data['contactedCompanies'] = $bkTool->getCompaniesByContactingStatus('Blir kontaktet');
               
		$this->render('companydistribution', $data);
	}

	public function actionPresentations() {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
                
                $bkTool = new Bktool();
		$data = array();
                $data['years'] = $this->getAllYearsSinceFounding();
                $data['companyEvents'] = $bkTool->getAllCompanyEvents();
                $data['oldCompanyEvents'] = $bkTool->getAllOldCompanyEvents();
                $data['oldCompanyEventsSumByYear'] = $bkTool->getSumOfOldCompanyEventsByYear();
                $data['companyEventsSumByYear'] = $bkTool->getPresentationsSumForAllYears();
                $data['sumOfPresentationsThisYear'] = 0;
            
		$this->render('presentations', $data);
	}

        public function actionGraduationyear($id) {
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
                $bkTool = new Bktool();
		$data = array();
                
                if(!isset($_GET['orderby'])){
                    $_GET['orderby'] = 'firstName';
                }
                if(!isset($_GET['order'])){
                    $_GET['order'] = 'DESC';
                } 
                
                switch($_GET['orderby']){
                    case 'specialization':
                        $_SESSION['orderby'] = 's.name';
                        break;
                    case 'workPlace':
                        $_SESSION['orderby'] = 'workPlace';
                        break;
                    case 'companyName':
                        $_SESSION['orderby'] = 'companyName';
                        break;
                    default:
                        $_SESSION['orderby'] = 'firstName';
                        break;
                }
                switch($_GET['order']){
                    case 'ASC':
                        $_SESSION['order'] = 'DESC';
                        break;
                    case 'DESC':
                        $_SESSION['order'] = 'ASC';
                        break;
                    default:
                        $_SESSION['order'] = 'DESC';
                        break;
                }
                
		$data['graduationYears'] = $bkTool->getAllGraduationYears();
                $data['graduatesByYear'] = $bkTool->getNumberOfGraduatesGroupedByYear();
                $data['employeesByYear'] = $bkTool->getNumberOfEmployedGraduatesGroupedByYear();
		$data['graduatesSum'] = $bkTool->getSumOfAllGraduates();
		$data['employingCompanies'] = $bkTool->getAllEmployingCompanies();
		$data['employeesSum'] = $bkTool->getSumOfAllEmployedGraduates();
		$data['employingCompaniesByYear'] = $bkTool->getEmployingCompaniesByYear($id);
                $data['employeesSumByYear'] = $bkTool->getSumOfEmployedGraduatesByYear($id);
                $data['graduatelistByYear'] = $bkTool->getGraduatesByYear($id, $_SESSION['orderby'], $_SESSION['order']);
                $data['graduatesSumByYear'] = $bkTool->getSumOfGraduatesByYear($id);
                $data['graduationyear'] = $id;
                
		$this->render('graduationyear', $data);
	}
        
        public function actionCompany($id){
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
                $bkTool = new Bktool();
		$data = array();
                $data['companyId'] = $id;
                $data['companyContactInfo'] = $bkTool->getCompanyContactInfoById($id);
                $data['presentationDates'] = $bkTool->getPresentationDatesByCompanyId($id);
                $data['oldPresentationDates'] = $bkTool->getOldPresentationDatesByCompanyId($id);
                $data['presentationsCount'] = $bkTool->getPresentationsCountByCompanyId($id);
                $data['oldPresentationsCount'] = $bkTool->getOldPresentationsCountByCompanyId($id);
                $data['employedGraduates'] = $bkTool->getEmployedGraduatesByCompanyId($id);
                $data['employedGraduatesSum'] = $bkTool->getSumOfEmployedGraduatesByCompanyId($id);
                $data['parentCompanyName'] = $bkTool->getParentCompanyBySubCompanyId($id);
                $data['relevantSpecializations'] = $bkTool->getRelevantSpecializationsByCompanyId($id);
                $data['timestamps'] = $bkTool->getAllCompanyTimestampsByCompanyId($id);
                $data['status'] = $bkTool->getStatusByCompanyId($id);
                $data['contactor'] = $bkTool->getContactorByCompanyId($id);
                $data['updater'] = $bkTool->getPersonWhichUpdatedLastByCompanyId($id);
                $data['adder'] = $bkTool->getPersonWhichAddedCompanyByCompanyId($id);
                $data['isMember'] = $bkTool->isCompanyIKTRingenMember($id);
                $data['iktRingenInfo'] = $bkTool->getIKTRingenInformationById($id);
                $data['iktRingenMembershipInfo'] = $bkTool->getIKTRingenMembershipInformationById($id);
                $data['commentsSum'] = $bkTool->getSumOfAllCommentsByCompanyId($id);
                $data['comments'] = $bkTool->getAllCommentsByCompanyId($id);
                $data['logo'] = $bkTool->getLogoById($id);
                $data['sumOfAllPresentations'] = 0;
                
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
                    $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, 'firstname', 'ASC');
                    foreach ($data['members'] as $member) :
                        $bkForms->addCompanyCommentUpdate($id, $member['id']);
                    endforeach;
                    
                    $bkForms->setCompanyAsUpdated($id);
                    
                    $this->actionCompany($id);
                }
        }


        public function actionEditcompany($id, $errordata=null){
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
                $bkTool = new Bktool();
		$data = array();
                $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, 'firstname', 'ASC');
                $data['membersSum'] = $bkTool->getSumOfAllActiveMembersByGroupId($this->bkGroupId);
                $data['companyContactInfo'] = $bkTool->getCompanyContactInfoById($id);
                $data['parentCompanyId'] = $bkTool->getParentCompanyBySubCompanyId($id);
                $data['isMember'] = $bkTool->isCompanyIKTRingenMember($id);
                $data['iktRingenInfo'] = $bkTool->getIKTRingenInformationById($id);
                $data['iktRingenMembershipInfo'] = $bkTool->getIKTRingenMembershipInformationById($id);
                $data['companiesList'] = $bkTool->getCompaniesDropDownArray();
                $data['relevantSpecializations'] = $bkTool->getRelevantSpecializationsByCompanyId($id);
                $data['status'] = $bkTool->getStatusByCompanyId($id);
                $data['contactor'] = $bkTool->getContactorByCompanyId($id);
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                $data['errordata'] = $errordata;
                $data['logo'] = $bkTool->getLogoById($id);
                
                $this->render('editcompany', $data);
        }
        
        public function actionEditcompanyform($id){
                $bkForms = new Bkforms();
                $bkTool = new Bktool();
		$errordata = array();
                $errordata['editedcompanyerror'] = '';
                $errordata['phonenumbererror'] = '';
                $errordata['postnumbererror'] = '';
                $errordata['parentcompanyerror'] = '';
                $phonenumber;
                $postnumber;
                $parentCompanyId = 0;
                $companyName;
                
                $data['thiscompany'] = $bkTool->getCompanyNameByCompanyId($id);
                
                $logo = CUploadedFile::getInstanceByName('logo');
                if ($logo !== null) {
                        $image = Image::uploadAndSave($logo, Yii::app()->user->id);
                        $bkForms->setLogoById($id, $image->id);
                }
                    
                foreach ($data['thiscompany'] as $company) :
                    $companyName = $company['companyName'];
                endforeach;
                
                if($bkForms->isInputFieldEmpty($_POST['editedcompany'])){
                    $errordata['error'] = true;
                    $errordata['editedcompanyerror'] = 'Bedriftsnavnet mangler';
                }
                else{
                    if($bkForms->isCompanyInDatabase($_POST['editedcompany']) && $companyName != $_POST['editedcompany']){
                        $errordata['error'] = true;
                        $errordata['editedcompanyerror'] = 'Bedriften finnes allerede i databasen';
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
                
                if($bkForms->isCompanySet($_POST['parentcompanyid'])){
                    $parentCompanyId = $_POST['parentcompanyid'];
                }
                
                if(isset($errordata['error'])){
                    $this->actionEditcompany($id, $errordata);
                }
                else{
                    $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, 'firstname', 'ASC');
                    foreach ($data['members'] as $member) :

                        if($bkForms->hasCompanyNameChanged($id, $_POST['editedcompany'])){
                            $bkForms->addCompanyNameUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyStatusChanged($id, $_POST['status'])){
                            $bkForms->addCompanyStatusUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyMailChanged($id, $_POST['mail'])){
                            $bkForms->addCompanyMailUpdate($member['id'], $id);
                        }
                        if($_POST['phonenumber'] > 0 && $bkForms->hasCompanyPhoneNumberChanged($id, $_POST['phonenumber'])){
                            $bkForms->addCompanyPhonenumberUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyAddressChanged($id, $_POST['address'])){
                            $bkForms->addCompanyAddressUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyPostboxChanged($id, $_POST['postbox'])){
                            $bkForms->addCompanyPostboxUpdate($member['id'], $id);
                        }
                        if($_POST['postnumber'] > 0 && $bkForms->hasCompanyPostnumberChanged($id, $_POST['postnumber'])){
                            $bkForms->addCompanyPostnumberUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyPostplaceChanged($id, $_POST['postplace'])){
                            $bkForms->addCompanyPostplaceUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyHomepageChanged($id, $_POST['homepage'])){
                            $bkForms->addCompanyHomepageUpdate($member['id'], $id);
                        }
                        if($bkForms->hasCompanyParentCompanyChanged($id, $parentCompanyId)){
                            if($bkForms->isCompanySet($parentCompanyId)){
                                $bkForms->addCompanyParentCompanyUpdate($member['id'], $id);
                            }
                        }
                        if(isset($_POST['contactor']) && $bkForms->hasCompanyContactorChanged($id, $_POST['contactor'])){
                            $bkForms->addCompanyContactorUpdate($member['id'], $id);         
                        }
                        if(isset($_POST['specializations']) && $bkForms->hasCompanySpecializationsChanged($id, $_POST['specializations'])){
                            $bkForms->addCompanySpecializationUpdate($member['id'], $id);
                        }
                    endforeach;
                    
                    if(isset($_POST['contactor']) && $bkForms->hasCompanyContactorChanged($id, $_POST['contactor'])){
                        $bkForms->updateCompanyContactor($id, $_POST['contactor']);
                    }
                    if(isset($_POST['specializations']) && $bkForms->hasCompanySpecializationsChanged($id, $_POST['specializations'])){
                        $bkForms->nullifyAllCompanySpecializationsByCompanyId($id);
                        
                        foreach ($_POST['specializations'] as $specializationId) :
                            $bkForms->insertCompanySpecialization($id, $specializationId);
                        endforeach;
                    }
                    if(!isset($_POST['specializations']) && $bkForms->hasCompanySpecializationsChanged($id, array())){
                        $bkForms->nullifyAllCompanySpecializationsByCompanyId($id);
                    }
                    
                    $bkForms->updateCompanyInformation($id, $_POST['editedcompany'], $_POST['mail'], $_POST['phonenumber'], $_POST['address'], 
                                $_POST['postbox'], $_POST['postnumber'], $_POST['postplace'], $_POST['homepage'], $parentCompanyId, $_POST['status']);
                    
                    $this->actionCompany($id);
                }
        }
        
        public function actionAddcompany($errordata=null){
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
                $bkTool = new Bktool();
		$data = array();
                $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, 'firstName', 'ASC');
                $data['membersSum'] = $bkTool->getSumOfAllActiveMembersByGroupId($this->bkGroupId);
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                $data['companiesList'] = $bkTool->getCompaniesDropDownArray();
                $data['errordata'] = $errordata;
                
                $this->render('addcompany', $data); 
        }
        
        public function actionAddcompanyform(){
                $bkForms = new Bkforms();
                $bkTool = new Bktool();
		$errordata = array();
                $errordata['addedcompanyerror'] = '';
                $errordata['phonenumbererror'] = '';
                $errordata['postnumbererror'] = '';
                $errordata['parentcompanyerror'] = '';
                $phonenumber;
                $postnumber;
                $parentCompanyId = 0;
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
                
                if($bkForms->isCompanySet($_POST['parentcompanyid'])){
                    $parentCompanyId = $_POST['parentcompanyid'];
                }
                
                if(isset($errordata['error'])){
                    $this->actionAddcompany($errordata);
                }
                else {
                    $bkForms->insertCompanyInformation($_POST['addedcompany'], $_POST['mail'], $_POST['phonenumber'], $_POST['address'], 
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
                    
                    $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, 'firstname', 'ASC');
                    foreach ($data['members'] as $member) :
                        $bkForms->addCompanyInsertionUpdate($member['id'], $companyId);
                        $bkForms->addCompanyStatusUpdate($member['id'], $companyId);
                        
                        if(!$bkForms->isInputFieldEmpty($_POST['mail'])){
                            $bkForms->addCompanyMailUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['phonenumber'])){
                            $bkForms->addCompanyPhonenumberUpdate($member['id'], $companyId);
                        }
                        if(!$bkForms->isInputFieldEmpty($_POST['address'])){
                            $bkForms->addCompanyAddressUpdate($member['id'], $companyId);
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
                        if($bkForms->isCompanySet($_POST['parentcompanyid'])){
                            $bkForms->addCompanyParentCompanyUpdate($member['id'], $companyId);
                        }
                        if(isset($_POST['contactor'])){
                            $bkForms->addCompanyContactorUpdate($member['id'], $companyId);
                        }
                        if(isset($_POST['specializations'])){
                            $bkForms->addCompanySpecializationUpdate($member['id'], $companyId);
                        }
                    endforeach;
                    
                    $this->actionCompanyOverview();
                }
        }

        public function actionEditgraduate($id, $errordata=null){
                $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');

                $bkTool = new Bktool();
		$data = array();
                $data['specializationNames'] = $bkTool->getAllSpecializationNames();
                $data['specializationNamesSum'] = $bkTool->getSumOfAllDistinctSpecializationNames();
                $data['graduationYears'] = $bkTool->getAllSelectableGraduationYears();
                $data['graduateInfo'] = $bkTool->getGraduateInfoByUserId($id);
                $data['companiesList'] = $bkTool->getCompaniesDropDownArray();
                $data['errordata'] = $errordata;
                
                $this->render('editgraduate', $data); 
        }
        
        public function actionEditgraduateform($id){
                $bkForms = new Bkforms();
                $bkTool = new Bktool();
		$data = array();
		$errordata = array();
                
                if(isset($errordata['error'])){ 
                    $this->actionEditgraduate($id, $errordata);
                }
                else{
                    $bkForms->updateGraduateAltEmail($id, $_POST['altemail']);
                    $bkForms->updateGraduateSpecialization($id, $_POST['specialization']);
                    $bkForms->updateGraduateWorkDescription($id, $_POST['workdescription']);
                    $bkForms->updateGraduateWorkPlace($id, $_POST['workplace']);
                    $bkForms->updateGraduateGraduationYear($id, $_POST['graduationyear']);
                    
                    if($bkForms->hasGraduateWorkCompanyChanged($id, $_POST['workcompanyid'])){
                            
                        $bkForms->updateGraduateWorkCompany($id, $_POST['workcompanyid']);

                        if($bkForms->isCompanySet($_POST['workcompanyid'])){
                                $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, 'firstname', 'ASC');
                                foreach ($data['members'] as $member) :
                                    $bkForms->addCompanyGraduateUpdate($member['id'], $_POST['workcompanyid']);
                                endforeach;
                        }
                }
                    
                $this->actionGraduates();
            }
        }
        
        public function actionEditmembers($errordata=null) {
            $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');
            
            if(!isset($_GET['orderby'])){
                $_GET['orderby'] = 'firstName';
            }
            if(!isset($_GET['order'])){
                $_GET['order'] = 'DESC';
            } 

            switch($_GET['orderby']){
                case 'comission':
                    $_SESSION['orderby'] = 'comission';
                    break;
                case 'firstName':
                    $_SESSION['orderby'] = 'firstName';
                    break;
                case 'start':
                    $_SESSION['orderby'] = 'start';
                    break;
                case 'username':
                    $_SESSION['orderby'] = 'username';
                    break;
                default:
                    $_SESSION['orderby'] = 'firstName';
                    break;
            }
            switch($_GET['order']){
                case 'ASC':
                    $_SESSION['order'] = 'DESC';
                    break;
                case 'DESC':
                    $_SESSION['order'] = 'ASC';
                    break;
                default:
                    $_SESSION['order'] = 'DESC';
                    break;
            }

            $bkTool = new Bktool();
            $data = array();
            $data['members'] = $bkTool->getAllActiveMembersByGroupId($this->bkGroupId, $_SESSION['orderby'], $_SESSION['order']);
            $data['membersSum'] = $bkTool->getSumOfAllActiveMembersByGroupId($this->bkGroupId);
            $data['formerMembers'] = $bkTool->getAllFormerMembersByGroupId($this->bkGroupId);
            $data['userList'] = $bkTool->getUsersDropDownArray();
            $data['errordata'] = $errordata;
            $data['model'] = $bkTool;

            $this->render('editmembers', $data);
        }
        
        public function actionEditmembersform() {
            $bkTool = new Bktool();
            $bkForms = new Bkforms();
            $data = array();
            $errordata = array();
            $i = 0;
            
            if(isset($_POST['selectedmembers'])){
                foreach ($_POST['selectedmembers'] as $memberId) :
                    $bkForms->deleteMemberById($memberId, $this->bkGroupId);
                    $bkForms->changeContactingStatusOnRemovalByMemberId($memberId);
                    $bkForms->deleteAllUpdatesRelevantToUser($memberId);
                endforeach;
            }
            
            foreach ($_POST['addedmembers'] as $memberId) :
                if($memberId != 0){
                    if(!$bkForms->isAlreadyGroupMember($memberId, $this->bkGroupId)){
                        $bkForms->addGroupMember($memberId, $this->bkGroupId, $_POST['addedcomissions'][$i]);
                    }
                    else{
                        $data['member'] = $bkTool->getMemberNameById($memberId);
                        foreach ($data['member'] as $member) :
                            $errordata[$i] = 'Brukeren '.$member['firstName'].' '.$member['middleName'].' '.$member['lastName'].' er allerede et medlem og ble ikke lagt til';
                        endforeach;
                    }
                }
            $i += 1;
            endforeach;
            
            $this->actionEditmembers($errordata);
        }

        public function actionEditmember($id, $errordata=null) {
            $this->setPageTitle($this->getNumberOfRelevantUpdatesAsString().' '.$this->organisationName.'-BK');

            $bkTool = new Bktool();
            $data = array();
            $data['membershipInfo'] = $bkTool->getMembershipInfoById($id, $this->bkGroupId);
            $data['errordata'] = $errordata;

            $this->render('editmember', $data);
        }
        
        public function actionEditmemberform($id) {
            $bkForms = new Bkforms();
            $errordata = array();
            
            if($_POST['start'] != ''){
                if(!strtotime($_POST['start'])){
                    $errordata['error'] = true;
                    $errordata['starttimeerror'] = 'Ugyldig startdato, bruk formatet YYYY-MM-DD.';
                }
            }
            else {
                $errordata['error'] = true;
                $errordata['starttimeerror'] = 'Medlemskapet må starte fra en dato.';
            }
            
            if($_POST['end'] != ''){
                if(strtotime($_POST['end'])){
                    if(date("Y-m-d", strtotime($_POST['end'])) < date("Y-m-d", strtotime($_POST['start']))){
                        $errordata['error'] = true;
                        $errordata['endtimeerror'] = 'Ugyldig sluttdato, sluttdato må være etter startdato.'; 
                    }
                }
                else{
                    $errordata['error'] = true;
                    $errordata['endtimeerror'] = 'Ugyldig sluttdato, bruk formatet YYYY-MM-DD.';
                }
            }
            
            if(isset($errordata['error'])){
                $this->actionEditmember($id, $errordata);
            }
            else {
                if($_POST['end'] == ''){
                    $enddate = '0000-00-00';
                }
                else{
                    $enddate = date("Y-m-d", strtotime($_POST['end']));
                    $bkForms->changeContactingStatusOnRemovalByMemberId($id);
                    $bkForms->deleteAllUpdatesRelevantToUser($id);
                }
                $bkForms->updateMembershipInfo($id, $this->bkGroupId, date("Y-m-d", strtotime($_POST['start'])), $enddate, $_POST['comission']);
                $this->actionEditmembers();
            }
        }
}