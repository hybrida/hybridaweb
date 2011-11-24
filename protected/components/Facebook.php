<?php
class Facebook{
    public $url = "http://dev.hybrida.no";
    
public function getAccessToken(){
	$userId = Yii::app()->user->id;
	$array = array( 'uID' => $userId );
	$sql = "SELECT fb_token FROM fb_user WHERE userId = :uID";
	$query = Yii::app()->db->getPdoInstance()->prepare($sql);
	$query->execute($array);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['fb_token'];
}

public function getUsername(){
	$userId = Yii::app()->user->id;
	$access_token = $this->getAccessToken();
	$url = 'https://graph.facebook.com/me?access_token='.$access_token;
	$content = file_get_contents($url);
	$content = explode('"',$content);
	$key = array_search('username', $content);
	$username = $content[$key+2];
	return $username;
}

public function retrieveProfilePicture(){
	$userId = Yii::app()->user->id;
	$username = getUsername();

	//Skriver ut profilbildet vha username (200piksler bred, variabel h�yde)
	$data = file_get_contents('https://graph.facebook.com/'.$username.'/picture?type=large');
        $file = new File;
        $file->put_image($data, '.jpg', $userId);
}

public function authLink(){ //Returnerer link til authentication
	$userId = Yii::app()->user->id;
	$app_id = '202808609747231';
	$my_url = $this->url . Yii::app()->baseURL . '/facebook/'; //oppdater path til endelig side 
	$dir = Yii::app()->baseURL . '/images/facebookconnectlogo.jpg';
	$permissions = 'publish_actions,offline_access';
	return '<a href="https://www.facebook.com/dialog/oauth?client_id='.$app_id.'&redirect_uri='.$my_url.'&scope='.$permissions.'"><img src="'.$dir.'"></a>';
}

public function setAttending($id){
	$userId = Yii::app()->user->id;
    $urlEventPage = $this->url . Yii::app()->baseURL . '/event/facebook/' . $id;
	$accessToken = $this->getAccessToken();
	$postUrl = 'https://graph.facebook.com/me/lfhybrida:attend';
	$data = array(
		'access_token' => $accessToken, 
		'event' => $urlEventPage, 
	);
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $postUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $out = curl_exec($ch);
	echo $out;
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
		'<meta property="og:type"        content="lfhybrida:event" />'."\n".
		'<meta property="og:url"         content="'.$urlEventPage.'" />'."\n".
		'<meta property="og:title"       content="'.$eventName.'" /></head>';//."\n".
		//'<meta property="og:description" content="'.$eventDesc.'" />';."\n".
		//'<meta property="og:image"       content="'.$linkImage.'" />';  
	return $metaData;
}

public function publishAtFanpage($id){
	$accessToken = 'AAAC4dA8kMR8BAJNCZBZASqncTWux3A6lJRgoLmGoDVvnt5CEb4fZCHDp6ZAvu2PVPchKZCl1HHV5bJyhY2bkqYbRSNC3rEAQipRyhhzzo96pm8h37ZB7rq';//statisk access token for hybrida fanpage
	$urlEventPage = $url . Yii::app()->baseURL . '/event/' . $id;
        $postUrl = 'https://graph.facebook.com/218073661595571/feed';
	$data = array(
		'access_token' => $accessToken, 
		'link' => $urlEventPage, 
                'message' => utf8_encode('har opprettet et arrangement')
	);
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $out = curl_exec($ch);
	echo $out;
        curl_close($ch);
}

public function publishNews($message, $id){
        $accessToken = 'AAAC4dA8kMR8BAJNCZBZASqncTWux3A6lJRgoLmGoDVvnt5CEb4fZCHDp6ZAvu2PVPchKZCl1HHV5bJyhY2bkqYbRSNC3rEAQipRyhhzzo96pm8h37ZB7rq';//statisk access token for hybrida fanpage
	$urlNewsPage = $url . Yii::app()->baseURL . '/news/' . $id;    //obs obs
        $postUrl = 'https://graph.facebook.com/218073661595571/feed';
	$data = array(
		'access_token' => $accessToken, 
		'link' => $urlEventPage, 
                'message' => utf8_encode($message)
	);
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $out = curl_exec($ch);
	echo $out;
        curl_close($ch);
}



// DETTE ER BÆRRE DRIIIT!!! hilsen Ole
/* public function createObject(){ //Kalles i body p� eventsiden. Lager eventobjektet p� facebook
	$appId = '202808609747231';
	$object = '<script src="http://connect.facebook.net/en_US/all.js"></script>'."\n".
			'<script> FB.init({ appId:'.$appId.', cookie:true,'."\n".
            'status:true, xfbml:true, oauth:true }); </script>'."\n".
			'<fb:add-to-timeline></fb:add-to-timeline>';
	return $object;
}
*/

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
