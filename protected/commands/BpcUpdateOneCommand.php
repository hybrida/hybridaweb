<?php

Yii::import("application.modules.bpc.components.*");
Yii::import("application.models.*");

class BpcUpdateOneCommand extends CConsoleCommand {

	public function run($args) {
		$bpcID = $args[0];
		$start = microtime(true);
		BpcCore::update($bpcID);
		$diff = microtime(true) - $start;
		echo "Ferdig etter $diff ms\n";
	}

}

