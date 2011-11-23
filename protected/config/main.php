<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme' => 'hybrida',
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Hybrida',
	'preload' => array('log'),
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.exceptions.*',
	),
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'gii',
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
		//'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',
	),
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => array("site/login"),
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'group/view/<id:\d+>/<title:\w+>' => 'group/view',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=hybrida',
			'emulatePrepare' => true,
			'username' => 'www-data',
			'password' => 'Q8JdU5MY7dDr5XEU',
			'charset' => 'utf8',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			// uncomment the following to show log messages on web pages
			/*
			  array(
			  'class'=>'CWebLogRoute',
			  ),
			 */
			),
		),
		'clientScript' => array(
			'scriptMap' => false,
		),
	),
	'params' => array(
		'baseUrl' => "dev.hybrida.no",
	),
);
