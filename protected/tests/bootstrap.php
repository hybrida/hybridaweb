<?php

// For at man fortsatt kan drive med innlogging og utlogging
// (endring av session) etter at testene har begynt å kjøre.
ob_start();


// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';
$globals=dirname(__FILE__).'/../../globals.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');
require_once($globals);

Yii::createWebApplication($config);
