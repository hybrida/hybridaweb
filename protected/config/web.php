<?php

class ConfigData {

	static function getScriptMap() {
		// For å få bruke lokale jquery-filer lokalt, mens jquery fra cdn i
		// prodkusjon. Dette gjørt at man kan jobbe selv uten nettilkobling.
		if (YII_DEBUG) {
			return array();
		} else {
			return array(
				'jquery.js' => "http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js",
				'jquery.min.js' => "http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js",
				'jquery-ui.min.js' => "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js",
			);
		}
	}

	static function getLoginUrl() {
		// For å få annen login-url lokalt på egen pc og i produksjon.
		if (YII_DEBUG) {
			return array("/dev/login",
						 'page' => $_SERVER['REQUEST_URI'],
						 'id' => 'admin');
		} else {
			return array("/site/login", 'page' => $_SERVER['REQUEST_URI']);
		}
	}

}

function beginRequest() {
	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
}


return array(
	'onBeginRequest' => 'beginRequest',
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Hybrida',
	'preload' => array('log'),
	'import' => array(
		'application.models.*',
		'application.components.widgets.*',
		'application.components.*',
		'application.components.helpers.*',
		'application.exceptions.*',
	),
	'controllerMap' => array(
	),
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'gii',
		),
		'ajax',
		'dev',
		'bk',
		'kilt',
		'gallery',
		'forum'=>array(
			'class'=>'application.modules.yii-forum.YiiForumModule',
		),
		'bpc' => array(
			// must be specified in main.php
			'requestUrl' => '',
			'foreningID' => 0,
			'handshakeID' => '',
		),
		'calendar',
		'comment',
		'timetracker',
		'search',
		'notifications',
		'jobAnnouncement',
	),
	'components' => array(
		'cache' => array(
			'class' => 'CDummyCache'
		),
		'authManager' => array(
			// Path to SDbAuthManager in srbac module if you want to use case insensitive
			//access checking (or CDbAuthManager for case sensitive access checking)
			'class' => 'CDbAuthManager',
			// The database component used
			'connectionID' => 'db',
			// The itemTable name (default:authitem)
			'itemTable' => 'rbac_item',
			// The assignmentTable name (default:authassignment)
			'assignmentTable' => 'rbac_assignment',
			// The itemChildTable name (default:authitemchild)
			'itemChildTable' => 'rbac_itemchild',
			'defaultRoles' => array('all'),
		),
		'gatekeeper' => array(
			'class' => 'GatekeeperComponent',
		),
		'notification' => array(
			'class' => 'notifications.components.NotificationComponent',
		),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => ConfigData::getLoginUrl(),

		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => require(dirname(__FILE__) . "/routes.php"),
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
				/*
				array(
					'class'=>'CWebLogRoute',
					'levels' => 'trace',
					'categories'=>'vardump',
				),
				*/
			),
		),
		'clientScript' => array(
			'scriptMap' => ConfigData::getScriptMap(),
		),
		'cliColor' => array(
			'class' => 'ext.yii-cli-color.components.KCliColor',
		),
	),
	'params' => array(
		'logoutUrl' => array("/site/logout"),
	),
);
