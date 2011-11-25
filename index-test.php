<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

$dir = dirname(__FILE__);
$yii = $dir.'/framework/yii.php';
$config = $dir.'/protected/config/test.php';
$globals = $dir."/globals.php";

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


require_once($yii);
Yii::createWebApplication($config)->run();
