<?php

class Install {

	public $sqlDir;

	public function __construct() {
		$this->sqlDir = Yii::getPathOfAlias('webroot.db') . "/";
	}

	public function install() {
		$structure = $this->sqlDir . "structure.sql";
		$data = $this->sqlDir . "data.sql";
		$this->executeSqlFile($structure);
		$this->executeSqlFile($data);
	}

	private function executeSqlFile($filePath) {
		echo __METHOD__ . "() " .$filePath . PHP_EOL;
		$sql = $this->getContentOfSQLFile($filePath);
		$this->executeSql($sql);
	}

	public function getContentOfSQLFile($file) {
		return file_get_contents($file);
	}

	private function executeSql($sql) {
		$stmt = Yii::app()->db->createCommand($sql);
		$stmt->execute();
	}

	public function update() {
		$sqlDrop = "DROP DATABASE IF EXISTS `hybrida_dev`;\n";
		$this->executeSql($sqlDrop);
		$this->install();
	}

}
