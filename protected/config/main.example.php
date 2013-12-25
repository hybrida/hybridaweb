<?php

$templatePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . "web.php";

$templateConf = require($templatePath);

return CMap::mergeArray($templateConf, array(
	'modules' => array(
		'bpc' => array(
			'requestUrl' => 'http://testing.bedriftspresentasjon.no/remote/',
			'foreningID' => 12,
			'handshakeID' => '27ede510ee989207365b8e9eef46309a82b8e7de',
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