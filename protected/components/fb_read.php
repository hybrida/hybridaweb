<?php

$error = $_GET['error'];
$code = $_GET['code'];

$app_id = '202808609747231';
$app_secret = '4b90c084ad62659c966beb8a62c9bf62';
$my_url = 'http://www.hybrida.no/php/fb_read.php'; //url til fila som skal lese inn code

if(isset($code)){
	$token_url = 'https://graph.facebook.com/oauth/access_token?client_id='.$app_id.'&redirect_uri='.$my_url.'&client_secret='.$app_secret.'&code='.$code;
	$access = file_get_contents($token_url);
	$params = null;
     	parse_str($access, $params);
	$access_token = $params['access_token'];
	
	//Sett $access_token inn i db
	$sql = 'INSERT INTO user_facebook VALUES ('.$userId.', '.$access_token.')';
	query($sql); 
	
	Header("Location: http://www.appletini.ivt.ntnu.no/yii"); //redirect tilbake til forsiden
	
}elseif(isset($error)){

	echo 'En feil har oppst�tt. Vennligst pr�v igjen';

}


?>