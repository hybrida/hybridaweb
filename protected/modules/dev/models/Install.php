<?php

class Install {
	
	public $sqlDir;
	
	public function __construct() {
		$this->sqlDir = Yii::getPathOfAlias('webroot') . "/backup.sql";
		$this->run();
	}
	
	public function run() {
		$sql = $this->getContentOfSQLFile();
		$stmt = Yii::app()->db->createCommand($sql);
		$stmt->execute();
	}
	
	public function getContentOfSQLFile() {
		return file_get_contents($this->sqlDir);
	}
	
	public static function install() {
		new Install();
	}
	
}