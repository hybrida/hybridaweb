<?php
class Facebook{

public function getAccessToken(){
	$userId = Yii::app()->user->id;
	$sql = "SELECT fb_token FROM user_facebook WHERE userId = ".$userId;
	$access_token = selectQuery($sql);
	return $access_token;
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

	//Skriver ut profilbildet vha username (200piksler bred, variabel høyde)
	return '<img src="https://graph.facebook.com/'.$username.'/picture?type=large"/>'; //linken bør lagres i databasen, hvis vi vil unngå å hente ut facebook-brukernavnet hele tiden
}

public function authLink(){ //Returnerer link til authentication
	$app_id = '202808609747231';
	$my_url = 'http://www.appletini.ivt.ntnu.no/yii/facebook/'; //oppdater path til endelig side 
	$dir = '../../images/facebookconnectlogo.jpg';
	
	$permissions = 'publish_actions,offline_access';
	return '<a href="https://www.facebook.com/dialog/oauth?client_id='.$app_id.'&redirect_uri='.$my_url.'&scope='.$permissions.'"><img src="'.$dir.'"></a>';
}

public function authLinkForPage(){ //Returnerer link til authentication av en page
	$app_id = '202808609747231';
	$my_url = 'http://www.appletini.ivt.ntnu.no/yii/facebook/'; //oppdater path til endelig side
	$dir = '../../images/facebookconnectlogo.jpg';

	return '<a href="https://www.facebook.com/dialog/oauth?client_id='.$app_id.'&redirect_uri='.$my_url.'&scope=manage_pages,publish_actions,offline_access"><img src="'.$dir.'"></a>';
}

public function setAttending($urlEventPage){
	$userId = Yii::app()->user->id;
	$accessToken = getAccessToken($userId);
	
	curl -F 'access_token='.$accessToken \
     -F 'company_presentation='.$urlEventPage \
        'https://graph.facebook.com/me/lfhybrida:attend';

}

public function removeAttending($eventName){
	$userId = Yii::app()->user->id;
	$accessToken = getAccessToken($userId);
	curl -X DELETE \
     -F 'access_token='.$accessToken \
        'https://graph.facebook.com/{'{id_from_create_call}'}'; //Oppdater denne ID'n
}

public function metaDataEvent($eventName, $eventDesc, $urlEventPage, $linkImage){ //Denne funksjonen skal kalles og skrives ut i head på eventsidene
	$metaData = '<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# lfhybrida: http://ogp.me/ns/fb/lfhybrida#">'\
		'<meta property="fb:app_id"      content="202808609747231" />' \
		'<meta property="og:type"        content="lfhybrida:company_presentation" />' \
		'<meta property="og:url"         content="'.$urlEventPage.'" />' \
		'<meta property="og:title"       content="'.$eventName.'" />' \
		'<meta property="og:description" content="'.$eventDesc.'" />' \
		'<meta property="og:image"       content="'.$linkImage.'" /></head>';  
	return $metaData;
}

public function createObject(){ //Kalles i body på eventsiden. Lager eventobjektet på facebook
	$appId = '202808609747231';
	$object = '<script src="http://connect.facebook.net/en_US/all.js"></script>'\
			'<script> FB.init({ appId:'.$appId.', cookie:true,'\
            'status:true, xfbml:true, oauth:true }); </script>'\
			'<fb:add-to-timeline></fb:add-to-timeline>';
	return $object;
}

public function setPageAttend(){
	$accessToken = //statisk access token for hybrida fanpage
	
	
}

// function updateAttending($userId, $eventName, $link){ //$link er en peker til event-siden. Denne er utdatert med tanke på facebook timeline
	// $access_token = getAccessToken($userId);
	// $username = getUsername($userId);

	// $post_url = 'https://graph.facebook.com/'.$username.'/feed';
	
	// $data['access_token'] = $access_token;
	// $data['message'] = utf8_encode('deltar på '.$eventName);
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
