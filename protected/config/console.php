<?php
include dirname(dirname(dirname(__FILE__))) . "/globals.php";

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

$main_temp = require dirname(__FILE__) . "/main.php";

$console_temp = array(
	'import' => array(
		'application.exceptions.*',
		'application.models.*',
	),
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Console Application',
	// application components
	'components' => array(
		'cliColor' => array(
			'class' => 'ext.yii-cli-color.components.KCliColor',
		),
	),
	'modules' => array(
		'dev','bpc',
	)
);

$console_temp['modules']['bpc'] = $main_temp['modules']['bpc'];
$console_temp['components']['db'] = $main_temp['components']['db'];

cdebug($console_temp);

return $console_temp;
