<?php

class FacebookController extends Controller {

    public function actionIndex(){
        
        //fb_read
        
        $code = $_REQUEST['code'];

        $userId = 327;//Yii::app()->user->id;
        $app_id = '202808609747231';
        $app_secret = '4b90c084ad62659c966beb8a62c9bf62';
        $my_url = 'http://appletini.ivt.ntnu.no/yii/facebook/'; //url til fila som skal lese inn code

        if(isset($_REQUEST['error'])){

            echo 'En feil har oppstått. Vennligst prøv igjen';
            echo $_REQUEST['error'];

        }
        elseif(isset($code)){
            $token_url = 'https://graph.facebook.com/oauth/access_token?client_id=' . $app_id . '&redirect_uri=' . $my_url . '&client_secret=' . $app_secret . '&code=' . $code;
            $access = file_get_contents($token_url);
            $params = null;
                parse_str($access, $params);
            $accessToken = $params['access_token'];

            $array=array('uID' => $userId, 'aToken' => $accessToken);

            //Sett $access_token inn i db
            $sql = 'INSERT INTO fb_user VALUES (:uID, :aToken)';
            $query = Yii::app()->db->getPdoInstance()->prepare($sql);
            $query->execute($array);

            Header("Location: http://appletini.ivt.ntnu.no/yii"); //redirect tilbake til forsiden
        }
    }
}

