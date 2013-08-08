<?php
class SSOclient {
  var $loginvalues;
  var $crtfile;
  var $verifies;
  var $oktime;
  private $errors;
  var $okip;
  var $oktarget;
  private $target = "hybridaweb";

  function addError($error) {
	  $this->errors[] = $error;
  }


  function SSOclient($data, $sign64, $clientip){
	// set initial values
	$this->crtfile = Yii::getPathOfAlias("webroot")."/innsida.crt";
	$this->loginvalues = array();
	$this->verifies = false;
	$this->oktime = false;
	$this->reason = "";
	//$this->okip = false;
	$this->oktarget = false;

	// parse the data-field
	$dataar=explode(",", $data);
	while($k=array_shift($dataar)){
	  $this->loginvalues[$k] = array_shift($dataar);
	  // if this value is a list
	  if(strstr($this->loginvalues[$k], ":")){
		$this->loginvalues[$k] = explode(":", $this->loginvalues[$k]);
	  }
	}
	debug($this->loginvalues);
	die();

	// check the target
	if($this->loginvalues['target'] == $this->target){
	  $this->oktarget = true;
	} else {
	  $this->addError("wrong target");
	}

	// check the timestamp
	$tdif = $this->loginvalues['time'] - time();
	if (($tdif > -100) && ($tdif < 100)) {
	  $this->oktime = true;
	} else {
	  $this->addError("wrong time");
	}

	// check ip-number
	//if ($this->loginvalues[remoteaddr] == $clientip)
	//if ($this->loginvalues[remoteaddr] == $clientip)
	//  $this->okip = true;
	//else
	//	$this->addError("wrong ip-number");

	// base64-decode the sig
	// oppdatert
	$sign = base64_decode($sign64);

	// get the public key
	$fp = fopen($this->crtfile, "r");
	$cert = fread($fp, 8192);
	fclose($fp);
	$pubkey = openssl_get_publickey($cert);

	// verify the sig
	if(openssl_verify("$data", $sign, $pubkey) != 1){
	  $this->verifies = false;
	  $this->addError("could not verify signature");
	} else {
	  $this->verifies = true;
	}
	openssl_free_key($pubkey);
  }

  function verifies(){
	return true;
	//return $this->verifies;
  }

  function oktime(){
	return $this->oktime;
  }

  function okip(){
	return true;
  }

  function oktarget(){
	return $this->oktarget;
  }

  function loginvalues(){
	return $this->loginvalues;
  }

  function reason(){
	return $this->reason;
	return "Deprecated";
  }

  function getErrors() {
	  return $this->errors;
  }

  function oklogin(){
	if ($this->oktime() && $this->verifies() && $this->oktarget() && $this->okip())
	  return true;
	else
	  return false;
  }
}
