<?php

class Install {

	public $sqlDir;

	public function __construct() {
		$this->sqlDir = Yii::getPathOfAlias('webroot.db') . "/db.sql";
	}

	public function install() {
		$sql = $this->getContentOfSQLFile();
		$stmt = Yii::app()->db->createCommand($sql);
		$stmt->execute();
	}

	public function getContentOfSQLFile() {
		return file_get_contents($this->sqlDir);
	}

	public function update() {
		$sqlDrop = "DROP DATABASE IF EXISTS `hybrida_dev`;\n";
		$sql = $sqlDrop . $this->getContentOfSQLFile();
		$stmt = Yii::app()->db->createCommand($sql);
		$stmt->execute();
	}

}
