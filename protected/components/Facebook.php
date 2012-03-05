<?php

class Facebook {
        public $accessToken = "AAAC4dA8kMR8BALCoPTGWcxpcJ3ZB7​M2g2LtKEmT5aZBo3pGzZA1mtQaE6DQ​hMAfV6x8yZAp19PttZCVThq6wB8Ymx​CuoG5HBq0z0nCb9eQQZDZD";
        public $pageId = "218073661595571";

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
		$access_token = $this->getAccessToken();
		$url = 'https://graph.facebook.com/me?access_token=' . $access_token;
		$content = file_get_contents($url);
		$content = explode('"', $content);
		$key = array_search('username', $content);
		$username = $content[$key + 2];
		return $username;
	}

	public function retrieveProfilePicture() {
		$username = getUsername();

		//Skriver ut profilbildet vha username (200piksler bred, variabel h�yde)
		$data = file_get_contents('https://graph.facebook.com/' . $username . '/picture?type=large');
		$file = new File;
		$file->put_image($data, '.jpg', $userId);
	}

	public function authLink() { //Returnerer link til authentication
		$app_id = '202808609747231';
		$my_url = Yii::app()->createAbsoluteUrl('/facebook/');
		$dir = Yii::app()->createAbsoluteUrl('/images/facebookconnectlogo.jpg');
		$permissions = 'publish_actions,offline_access';
		return '<a href="https://www.facebook.com/dialog/oauth?client_id=' . $app_id . '&redirect_uri=' . $my_url . '&scope=' . $permissions . '"><img src="' . $dir . '"></a>';
	}

	public function setAttending($id) {
                $urlEventPage = Yii::app()->createAbsoluteUrl('/event/'.$id);
                echo $urlEventPage;
		$accessToken = $this->getAccessToken();
		$postUrl = 'https://graph.facebook.com/me/lfhybrida:attend';
		$data = array(
			'access_token' => $accessToken,
			'event' => $urlEventPage,
		);
		$this->runCurl($data, $postUrl);
	}
        
	public function publishAtFanpage($id) {
                $urlEventPage = Yii::app()->createAbsoluteUrl('/event?id=');
                $urlEventPage=urlEventPage.$id;
		$postUrl = 'https://graph.facebook.com/'.$this->pageId.'/feed';
                $data['link'] = $urlEventPage;
		$data['message'] = utf8_encode('har opprettet et arrangement');
		$data['access_token'] = $this->accessToken;
		$this->runCurl($data, $postUrl);
	}

	public function publishNews($message, $id) {
		$urlEventPage = Yii::app()->createAbsoluteUrl('/news?id=');
                $urlEventPage=urlEventPage.$id;
		$postUrl = "https://graph.facebook.com/".$this->pageId."/feed";
		$data['link'] = $urlNewsPage;
		$data['message'] = $message;
		$data['access_token'] = $this->accessToken;
		$this->runCurl($data, $postUrl);
	}
	public function runCurl($data, $postUrl) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$return = curl_exec($ch);
		curl_close($ch);
	}
}
