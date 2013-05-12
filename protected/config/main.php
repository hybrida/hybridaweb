<?php

function beginRequest() {
	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
}

return array(
	'onBeginRequest' => 'beginRequest',
	'theme' => 'hybrida',
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
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
		//'ipFilters'=>array('127.0.0.1','::1'),
		),
		'ajax',
		'dev',
		'bk',
		'kilt',
		'gallery',
		'bpc',
		'calendar',
		'comment',
		'search',
		'notifications',
		'jobAnnouncement',
		'srbac' => array(
			'userclass' => 'User', //default: User
			'userid' => 'id', //default: userid
			'username' => 'username', //default:username
			'delimeter' => '@', //default:-
			'debug' => false, //default :false
			'pageSize' => 10, // default : 15
			'superUser' => 'admin', //default: Authorizer
			'css' => 'srbac.css', //default: srbac.css
			'layout' => '//layouts/singleColumn',
			'notAuthorizedView' => 'srbac.views.authitem.unauthorized', // default:
			//srbac.views.authitem.unauthorized, must be an existing alias
			'alwaysAllowed' => array(),
			'userActions' => array('Show', 'View', 'List'), //default: array()
			'listBoxNumberOfLines' => 15, //default : 10
			'imagesPath' => 'srbac.images', // default: srbac.images
			'imagesPack' => 'noia', //default: noia
			'iconText' => true, // default : false
			'header' => 'srbac.views.authitem.header', //default : srbac.views.authitem.header,
			//must be an existing alias
			'footer' => 'srbac.views.authitem.footer', //default: srbac.views.authitem.footer,
			//must be an existing alias
			'showHeader' => true, // default: false
			'showFooter' => true, // default: false
			'alwaysAllowedPath' => 'srbac.components', // default: srbac.components
		// must be an existing alias
		)
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
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => array("/site/login", 'page' => $_SERVER['REQUEST_URI']),
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'admin/articles' => '/admin/articles',
				'admin/news' => '/admin/news',
                'admin/stats' => '/admin/stats',
				'artikler/<id:\d+>/<title>' => '/article/view',
				'alumni/form' => 'alumni/form',
				'alumni' => '/graduate/index',
				'alumni/<id:\d+>' => '/graduate/graduationyear',
				'alumni/<action:\w+>' => '/graduate/<action>',
				'bk' => 'bk/bktool/index',
				'bk/<action:\w+>' => 'bk/bktool/<action>',
				'bedpres/<id:\d+>/<title>' => 'bpc/default/view',
				'get/<extra:\w+>' => 'ajax/get/<extra>',
				'grupper' => 'group/index',
				'grupper/<url:\w+>' => '/group/view',
				'grupper/<url:\w+>/<action:\w+>' => 'group/<action>',

				'gallery' => 'gallery/album',
				'gallery/<id:\d+>' => 'gallery/album/view',
				'gallery/<id:\d+>/<pid:\d+>' => 'gallery/album/picview',
				'gallery/<action:\w+>' => 'gallery/album/<action>',
				'gallery/<action:\w+>/<id:\d+>' => 'gallery/album/<action>',
				'gallery/<action:\w+>/<id:\d+>/<pid:\d+>' => 'gallery/album/<action>',

				'jobb' => 'jobAnnouncement/jobAnnouncement/index',
				'jobb/<id:\d>/<name>' => 'jobAnnouncement/jobAnnouncement/view',
				'jobb/<action:\w+>' => 'jobAnnouncement/jobAnnouncement/<action>',
				'bilde/<size:\w+>/<id:\d+>' => 'image/view',
				'notifications' => '/notifications/default/index',
				'nyheter/<id:\d+>/<title>' => 'news/view',
				'nyheter' => 'newsfeed/index',
				'profil' => '/profile/',
				'profil/<username:\w+>' => '/profile/info/',
				'profil/<username:\w+>/<action:\w+>' => 'profile/<action>/',
				'kalender' => '/calendar/default/index',
				'test' => 'dev/default/test',
				'html' => 'dev/default/html',

				'dev/login/<id:\w+>' => 'dev/default/login',
				'<module:(dev|ajax)>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
				'<module:(dev|ajax)>/<action:\w+>' => '<module>/default/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=hybrida_dev',
			'emulatePrepare' => true,
			'username' => 'www-data',
			'password' => 'Q8JdU5MY7dDr5XEU',
			'charset' => 'utf8',
			'schemaCachingDuration' => 1000,
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
			'scriptMap' => array(
				'jquery.js' => "http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js",
				'jquery.min.js' => "http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js",
				'jquery-ui.min.js' => "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js",
			),
		),
		'cliColor' => array(
			'class' => 'ext.yii-cli-color.components.KCliColor',
		),
	),
	'params' => array(
		'logoutUrl' => array("/site/logout"),
	),
);
