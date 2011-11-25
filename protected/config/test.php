<?php

return CMap::mergeArray(
				require(dirname(__FILE__) . '/main.php'), array(
			'import' => array(
				'application.models.*',
				'application.components.*',
				'application.exceptions.*',
				'application.tests.testlib.*'
			),
			'components' => array(
				'fixture' => array(
					'class' => 'system.test.CDbFixtureManager',
				),
				'user' => array(
					'loginUrl' => array("dev/login", 'id' => 2),
				),
				'urlManager' => array(
					'urlFormat' => 'get',
					'showScriptName' => true,
				),
			/* uncomment the following to provide test database connection
			  'db'=>array(
			  'connectionString'=>'DSN for test database',
			  ),
			 */
			),
				)
);
