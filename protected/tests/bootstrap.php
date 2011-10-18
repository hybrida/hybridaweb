<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);

// Login --------------------------
/*
$userIdentity = new InnsidaIdentity(381); // Sigurd
$userIdentity->authenticate();
Yii::app()->user->login($userIdentity);
 /**/
