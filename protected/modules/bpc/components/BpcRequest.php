<?php

class BpcRequest {

	private static $foreningID = 12;
	private static $handshakeID = '27ede510ee989207365b8e9eef46309a82b8e7de';
	private static $responseMethod = 'serialized_array';
	private static $requestUrl = "You are not allowed to connect to bpc from this url";
//	private static $requestUrl = 'http://testing.bedriftspresentasjon.no/remote/';
//	private static $requestUrl = 'http://www.bedriftspresentasjon.no/remote/';
	private static $isDebug = false;
	private static $timing = false;
	private static $version = '1.1';
	private $postdata = array();
	private $curl = null;
	private $curlResponse = null;

	public function __construct($postdata) {
		$this->setPostdata($postdata);
	}

	private function setPostdata($postdata) {
		$this->initCommonPostdata();
		$this->postdata = array_merge($this->postdata, $postdata);
	}

	private function initCommonPostdata() {
		$this->postdata = array(
			'forening' => self::$foreningID,
			'key' => self::$handshakeID,
			'debug' => self::$isDebug,
			'timing' => self::$timing,
			'version' => self::$version,
			'method' => self::$responseMethod,
		);
	}

	public function send() {
		$this->initCurl();
		$this->sendRequest();
		$this->closeCurl();
	}

	private function initCurl() {
		$this->curl = curl_init();
		$this->initCurlOptions();
	}

	private function initCurlOptions() {
		curl_setopt($this->curl, CURLOPT_URL, self::$requestUrl);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->postdata);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->curl, CURLOPT_HEADER, FALSE);
		curl_setopt($this->curl, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 1);
	}

	protected function sendRequest() {
		$this->curlResponse = curl_exec($this->curl);
		if (!$this->curlResponse) {
			throw new CurlRequestFailedException(curl_error($this->curl));
		}
	}

	private function closeCurl() {
		curl_close($this->curl);
	}

	public function getResponse() {
		$response = @unserialize($this->curlResponse);
		if (!$response) {
			throw new BpcServerException($this->curlResponse);
		}
		return $response;
	}

}
