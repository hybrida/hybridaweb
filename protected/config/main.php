<?php

function endRequest($event) {
	$app = Yii::app();
	$ajaxRegList = array(
		'/get/', '/post$/', '/image/'
	);
	$isAjaxRequest = Yii::app()->request->isAjaxRequest;
	foreach ($ajaxRegList as $bad) {
		$isAjaxRequest |= preg_match($bad, $app->request->getUrl());
	}
	$notLoginUrl = $app->createUrl($app->user->loginUrl[0]) != $app->request->getUrl();
	if ($notLoginUrl && !$isAjaxRequest) {
		$app->user->setReturnUrl($app->request->getUrl());
	}
}

function beginRequest() {
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js");
	$cs->registerScriptFile("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js");
}

return array(
	'onEndRequest' => 'endRequest',
	'onBeginRequest' => 'beginRequest',
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
		'ajax',
		'dev',
		'bk',
		'comment',
		'search',
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
				'get/<extra:\w+>' => 'ajax/get/<extra>',
				'group/view/<id:\d+>/<title:\w+>' => 'group/view',
				'<module:(dev|ajax)>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
				'<module:(dev|ajax)>/<action:\w+>' => '<module>/default/<action>',
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
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery-ui.css' => false,
			),
		),
	),
	'params' => array(
		'baseUrl' => "dev.hybrida.no",
	),
);
