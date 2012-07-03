<?php

Yii::import("application.modules.bpc.components.*");
Yii::import("application.models.*");

class BpcUpdateCommand extends CConsoleCommand {

	public function run($args) {
		echo "Starter henting av bpc-eventer ..." . PHP_EOL;
		$start = microtime(true);
		BpcCore::updateAll();
		$diff = microtime(true) - $start;
		echo "Ferdig etter $diff ms\n";
	}

}