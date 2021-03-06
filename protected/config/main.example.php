<?php

// Denne filen kjøres to ganger: Først gang for å laste inn alle konstanter, og
// andre gang for å hente inn konfigurasjon. Dette gjøres slik at all
// konfigurasjon finnes på ett sted.

//// Yii-instillinger ---------------------------------------------------
if (!defined('YII_DEBUG')) {

	// remove the following lines when in production mode
	define('YII_DEBUG',true);

	// specify how many levels of call stack should be shown in each log message
	define('YII_TRACE_LEVEL',3);

	return;
}
//// App-instillinger -------------------------------------------------

$templatePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . "web.php";
$templateConf = require($templatePath);

return CMap::mergeArray($templateConf, array(
	'modules' => array(
		'bpc' => array(
			'requestUrl' => 'http://bedriftspresentasjon.no/remote/',
			'foreningID' => 12,
			'handshakeID' => 'c41d13e6ab5445e04c6fe6ee82c9cbedd27a2dfe',
		),
	),
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=hybrida_dev',
			'emulatePrepare' => true,
			'username' => 'www-data',
			'password' => 'Q8JdU5MY7dDr5XEU',
			'charset' => 'utf8',
			'schemaCachingDuration' => 1000,
		),
	),
));
