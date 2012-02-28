<?php

class Install {
	
	public $sqlDir;
	
	public function __construct() {
		$this->sqlDir = Yii::getPathOfAlias('webroot') . "/backup.sql";
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
		$sqlDrop.= "DROP DATABASE IF EXISTS `hybrida`;\n";
		$sql = $sqlDrop . $this->getContentOfSQLFile();
		$stmt = Yii::app()->db->createCommand($sql);
		$stmt->execute();
	}
	
}
