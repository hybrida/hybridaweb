<?php

Yii::import('dev.models.Install');

class UpdateCommand extends CConsoleCommand {

	public function run($args) {
		$install = new Install;
		$install->sqlDir = dirname(dirname(dirname(__FILE__))) . "/db/db.sql";
		echo "Oppdaterer databasen\n";
		$install->update();
		echo "Success!\n";
	}

}