<?php

class Facebook {

	public $url = "http://dev.hybrida.no";
        public $accessToken = "AAAC4dA8kMR8BALCoPTGWcxpcJ3ZB7​M2g2LtKEmT5aZBo3pGzZA1mtQaE6DQ​hMAfV6x8yZAp19PttZCVThq6wB8Ymx​CuoG5HBq0z0nCb9eQQZDZD";

	public function getAccessToken() {
		$userId = Yii::app()->user->id;
		$array = array('uID' => $userId);
		$sql = "SELECT fb_token FROM fb_user WHERE userId = :uID";
		$query = Yii::app()->db->getPdoInstance()->prepare($sql);
		$query->execute($array);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['fb_token'];
	}

	public function getUsername() {
		$userId = Yii::app()->user->id;
		$access_token = $this->getAccessToken();
		$url = 'https://graph.facebook.com/me?access_token=' . $access_token;
		$content = file_get_contents($url);
		$content = explode('"', $content);
		$key = array_search('username', $content);
		$username = $content[$key + 2];
		return $username;
	}

	public function retrieveProfilePicture() {
		$userId = Yii::app()->user->id;
		$username = getUsername();

		//Skriver ut profilbildet vha username (200piksler bred, variabel h�yde)
		$data = file_get_contents('https://graph.facebook.com/' . $username . '/picture?type=large');
		$file = new File;
		$file->put_image($data, '.jpg', $userId);
	}

	public function authLink() { //Returnerer link til authentication
		$userId = Yii::app()->user->id;
		$app_id = '202808609747231';
		$my_url = $this->url . Yii::app()->baseURL . '/facebook/'; //oppdater path til endelig side 
		$dir = Yii::app()->baseURL . '/images/facebookconnectlogo.jpg';
		$permissions = 'publish_actions,offline_access';
		return '<a href="https://www.facebook.com/dialog/oauth?client_id=' . $app_id . '&redirect_uri=' . $my_url . '&scope=' . $permissions . '"><img src="' . $dir . '"></a>';
	}

	public function setAttending($id) {
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
		echo "<!--" . $out . "-->";
		curl_close($ch);
	}

	public function metaDataEvent($eventName, $urlEventPage) { //Denne funksjonen skal kalles og skrives ut i head p� eventsidene
		$metaData = '<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# lfhybrida: http://ogp.me/ns/fb/lfhybrida#">' . "\n" .
				'<meta property="fb:app_id"      content="202808609747231" />' . "\n" .
				'<meta property="og:type"        content="lfhybrida:event" />' . "\n" .
				'<meta property="og:url"         content="' . $urlEventPage . '" />' . "\n" .
				'<meta property="og:title"       content="' . $eventName . '" /></head>'; //."\n".
		//'<meta property="og:description" content="'.$eventDesc.'" />';."\n".
		//'<meta property="og:image"       content="'.$linkImage.'" />';  
		return $metaData;
	}

	public function publishAtFanpage($id) {
        $urlEventPage = $url . Yii::app()->baseURL . '/event/' . $id;
		$postUrl = 'https://graph.facebook.com/218073661595571/feed';
		$data = array(
			'access_token' => $accessToken,
			'link' => $urlEventPage,
			'message' => utf8_encode('har opprettet et arrangement')
		);
		$this->runCurl($data, $postUrl);
	}

	public function publishNews($message, $id) {
		//$urlNewsPage = $url . Yii::app()->baseURL . '/news/' . $id; //obs obs
		$postUrl = "https://graph.facebook.com/218073661595571/feed";
		$data['link'] = "http://dev.hybrida.no/news";
		$data['message'] = "Melding";
		$data['access_token'] = $accessToken;
		$this->runCurl($data, $postUrl);
	}
	public function runCurl($data, $postUrl) {
	echo("\n");
	echo($postUrl);
	echo("\n");
	echo(print_r($data[, $return=true]));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$return = curl_exec($ch);
		curl_close($ch);
		
		echo($return);
	}
}
