<?php
Yii::import('dev.models.Install');
class UpdateCommand extends CConsoleCommand {

	public function run() {

		$install = new Install;
		$install->sqlDir = dirname(dirname(dirname(__FILE__))) . "/backup.sql";
		echo "Oppdaterer databasen\n";
		$install->update();
		echo "Success!\n";
	}


}
