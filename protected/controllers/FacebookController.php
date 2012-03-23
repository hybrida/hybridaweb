<?php

class FacebookController extends Controller {

    public function actionIndex(){
        $code = $_REQUEST['code'];
        
        if(isset($_REQUEST['error'])){
            echo 'En feil har oppstått. Vennligst prøv igjen';
            echo $_REQUEST['error'];

        }
        elseif(isset($code)){
            $fb = new Facebook;
            $fb->addAccessToken($code);
        }
    }
}

