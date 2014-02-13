<?php


$dir = dirname(__FILE__);
$yii = $dir.'/framework/yii.php';
$config = $dir.'/protected/config/main.php';
$globals = $dir."/globals.php";

require($config);

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
