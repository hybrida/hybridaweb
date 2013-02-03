<?php
include dirname(dirname(dirname(__FILE__))) . "/globals.php";

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'import' => array(
		'application.exceptions.*',
		'application.models.*',
	),
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Console Application',
	// application components
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=hybrida_dev',
			'emulatePrepare' => true,
			'username' => 'www-data',
			'password' => 'Q8JdU5MY7dDr5XEU',
			'charset' => 'utf8',
		),
		'cliColor' => array(
			'class' => 'ext.yii-cli-color.components.KCliColor',
		),
	),
	'modules' => array(
		'dev','bpc',
	)
);
