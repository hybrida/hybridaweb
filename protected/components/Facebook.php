<?php
class Facebook{

public function getAccessToken(){
	$userId = Yii::app()->user->id;
	$array = array( 'uID' => $userId );
	$sql = "SELECT fb_token FROM user_facebook WHERE userId = :uID";
	$query = Yii::app()->db->getPdoInstance()->prepare($sql);
	$query->execute($array);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['fb_token'];
}

public function getUsername(){
	$userId = Yii::app()->user->id;
	$access_token = getAccessToken($userId);
	$url = 'https://graph.facebook.com/me?access_token='.$access_token;
	$content = file_get_contents($url);
	$content = explode('"',$content);
	$key = array_search('username', $content);
	$username = $content[$key+2];
	return $username;
}

public function getProfilePicture(){
	$userId = Yii::app()->user->id;
	$username = getUsername($userId);

	//Skriver ut profilbildet vha username (200piksler bred, variabel h�yde)
	return '<img src="https://graph.facebook.com/'.$username.'/picture?type=large"/>'; //linken b�r lagres i databasen, hvis vi vil unng� � hente ut facebook-brukernavnet hele tiden
}

public function authLink(){ //Returnerer link til authentication
	$app_id = '202808609747231';
	$my_url = 'http://appletini.ivt.ntnu.no/yii/facebook/'; //oppdater path til endelig side 
	$dir = Yii::app()->baseURL . '/images/facebookconnectlogo.jpg';
	$permissions = 'publish_actions,offline_access';
	
	return '<a href="https://www.facebook.com/dialog/oauth?client_id='.$app_id.'&redirect_uri='.$my_url.'&scope='.$permissions.'"><img src="'.$dir.'"></a>';
}

public function authLinkForPage(){ //Returnerer link til authentication av en page
	$app_id = '202808609747231';
	$my_url = 'http://www.appletini.ivt.ntnu.no/yii/facebook/'; //oppdater path til endelig side
	$dir = '../../images/facebookconnectlogo.jpg';
	$permissions = 'manage_pages,publish_actions,offline_access';
	
	return '<a href="https://www.facebook.com/dialog/oauth?client_id='.$app_id.'&redirect_uri='.$my_url.'&scope='.$permissions.'"><img src="'.$dir.'"></a>';
}

public function setAttending($urlEventPage){
	$userId = Yii::app()->user->id;
	$accessToken = getAccessToken($userId);
	$postUrl = 'https://graph.facebook.com/me/lfhybrida:attend';
	$data = array(
		'access_token' => $accessToken, 
		'company_presentation' => $urlEventPage, 
	);
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $postUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $out = curl_exec($ch);
	
    curl_close($ch);
}

//removeAttending trenger ID'n returnert av setAttending (alts� variabelen: $out)
/* public function removeAttending($eventName){
	$userId = Yii::app()->user->id;
	$accessToken = getAccessToken($userId);
	$userId = Yii::app()->user->id;
	$array = array( 'uID' => $userId );
	
	$sql = "";
	$query = Yii::app()->db->getPdoInstance()->prepare($sql);
	$query->execute($array);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	
	$postUrl =  'https://graph.facebook.com/{'{.$attendId.}'}';
	$data = array('request' => 'DELETE', 'access_token' => $accessToken);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $postUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $out = curl_exec($ch);
    curl_close($ch);
	
	return $out;
} */

public function metaDataEvent($eventName, $urlEventPage){ //Denne funksjonen skal kalles og skrives ut i head p� eventsidene
	$metaData = '<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# lfhybrida: http://ogp.me/ns/fb/lfhybrida#">'."\n".
		'<meta property="fb:app_id"      content="202808609747231" />'."\n".
		'<meta property="og:type"        content="lfhybrida:company_presentation" />'."\n".
		'<meta property="og:url"         content="'.$urlEventPage.'" />'."\n".
		'<meta property="og:title"       content="'.$eventName.'" />';//."\n".
		//'<meta property="og:description" content="'.$eventDesc.'" />';."\n".
		//'<meta property="og:image"       content="'.$linkImage.'" /></head>';  
	return $metaData;
}

public function createObject(){ //Kalles i body p� eventsiden. Lager eventobjektet p� facebook
	$appId = '202808609747231';
	$object = '<script src="http://connect.facebook.net/en_US/all.js"></script>'."\n".
			'<script> FB.init({ appId:'.$appId.', cookie:true,'."\n".
            'status:true, xfbml:true, oauth:true }); </script>'."\n".
			'<fb:add-to-timeline></fb:add-to-timeline>';
	return $object;
}

public function publishAtFanpage(){
	$accessToken = '';//statisk access token for hybrida fanpage
	
}

// function updateAttending($userId, $eventName, $link){ //$link er en peker til event-siden. Denne er utdatert med tanke p� facebook timeline
	// $access_token = getAccessToken($userId);
	// $username = getUsername($userId);

	// $post_url = 'https://graph.facebook.com/'.$username.'/feed';
	
	// $data['access_token'] = $access_token;
	// $data['message'] = utf8_encode('deltar p� '.$eventName);
	// $data['link'] = $link;	
        
	// $ch = curl_init();
 
        // curl_setopt($ch, CURLOPT_URL, $post_url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
        // // execute and close
        // $out = curl_exec($ch);
        // curl_close($ch);
 
        // // end
        // return $out;   
//}
}
?>
