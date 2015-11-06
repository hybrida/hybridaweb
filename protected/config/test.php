<?php

return CMap::mergeArray(require(dirname(__FILE__) . '/main.php'),
	array(
		'import' => array(
			'application.models.*',
			'application.components.*',
			'application.exceptions.*',
			'application.tests.testlib.*',
			'application.tests.mocks.*',
		),
		'components' => array(
			'fixture' => array(
				'class' => 'system.test.CDbFixtureManager',
			),
			'user' => array(
				'loginUrl' => "dev/login/381",
			),
			'urlManager' => array(
				'urlFormat' => 'get',
				'showScriptName' => true,
			),
			'db' => array(
				'connectionString' => 'mysql:host=localhost;dbname=hybrida_dev',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'schemaCachingDuration' => 1000,
			),
		),
	)
);
