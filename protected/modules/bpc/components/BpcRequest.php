<?php

class BpcRequest {

	private static $responseMethod = 'serialized_array';

	private $module;

	private $postdata = array();
	private $curl = null;
	private $curlResponse = null;

	public function __construct($postdata) {
		$this->module = Yii::app()->getModule('bpc');
		$this->setPostdata($postdata);
	}

	private function setPostdata($postdata) {
		$this->initCommonPostdata();
		$this->postdata = array_merge($this->postdata, $postdata);
	}

	private function initCommonPostdata() {
		$this->postdata = array(
			'forening' => $this->module->foreningID,
			'key' => $this->module->handshakeID,
			'debug' => $this->module->isDebug,
			'timing' => $this->module->timing,
			'version' => $this->module->version,
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
		curl_setopt($this->curl, CURLOPT_URL, $this->module->requestUrl);
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
