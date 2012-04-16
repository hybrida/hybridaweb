<?php

class Facebook {
        public $accessToken = "AAAC4dA8kMR8BALCoPTGWcxpcJ3ZB7​M2g2LtKEmT5aZBo3pGzZA1mtQaE6DQ​hMAfV6x8yZAp19PttZCVThq6wB8Ymx​CuoG5HBq0z0nCb9eQQZDZD";
        public $pageId = "218073661595571";
        public $app_id = '202808609747231';
        public $app_secret = '4b90c084ad62659c966beb8a62c9bf62';

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
                $title = News::model()->findByPk($id)->title;
                $urlEventPage = Yii::app()->createAbsoluteUrl('/news/view', array('id' => $id, 'title' => $title));
		$accessToken = $this->getAccessToken();
		$postUrl = 'https://graph.facebook.com/me/lfhybrida:attend';
		$data = array(
			'access_token' => $accessToken,
			'event' => $urlEventPage,
		);
		$this->runCurl($data, $postUrl);
	}
        
	public function publishEventAtFanpage($eventId) {
                $title = News::model()->findByPk($id)->title;
                $urlEventPage = Yii::app()->createAbsoluteUrl('/news/view', array('id' => $id, 'title' => $title));
		$postUrl = 'https://graph.facebook.com/'.$this->pageId.'/feed';
                $data['link'] = $urlEventPage;
		$data['message'] = utf8_encode('har opprettet et arrangement');
		$data['access_token'] = $this->accessToken;
		$this->runCurl($data, $postUrl);
	}

	public function publishNewsAtFanpage($newsId, $message) {
		$title = News::model()->findByPk($id)->title;
                $urlEventPage = Yii::app()->createAbsoluteUrl('/news/view', array('id' => $id, 'title' => $title));
		$postUrl = "https://graph.facebook.com/".$this->pageId."/feed";
		$data['link'] = $urlNewsPage;
		$data['message'] = utf8_encode($message);
		$data['access_token'] = $this->accessToken;
		$this->runCurl($data, $postUrl);
	}
        
	private function runCurl($data, $postUrl) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$return = curl_exec($ch);
		curl_close($ch);
	}
        
        public function addAccessToken($code){
            $userId = Yii::app()->user->id;
            $my_url = Yii::app()->createAbsoluteUrl('');
                        
            $token_url = 'https://graph.facebook.com/oauth/access_token?client_id=' . $this->app_id . '&redirect_uri=' . $my_url . '/facebook&client_secret=' . $this->app_secret . '&code=' . $code;
            $access = file_get_contents($token_url); 
            $params = null;
            parse_str($access, $params);
            $accessToken = $params['access_token'];
            
            $array=array('uID' => $userId, 'aToken' => $accessToken);
            $sql = 'INSERT INTO fb_user VALUES (:uID, :aToken) ON DUPLICATED SET userId = :uID';
            $query = Yii::app()->db->getPdoInstance()->prepare($sql);
            $query->execute($array);
            
            Header("Location: ".$my_url); //redirect tilbake til forsiden
        }
}
