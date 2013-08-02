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
		echo __METHOD__ . "() " . $filePath . PHP_EOL;
		$sql = $this->getContentOfSQLFile($filePath);
		$this->executeSql($sql);
	}

	public function getContentOfSQLFile($file) {
		return file_get_contents($file);
	}

	private function executeSql($sql) {
		$sqlQueries = $queries = preg_split('/[.+;][\s]*\n/', $sql, -1, PREG_SPLIT_NO_EMPTY);
		try {
			foreach ($sqlQueries as $sql) {
				$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
				$stmt->execute();
			}
		} catch (PDOException $e) {
			echo PHP_EOL;
			echo $this->color("Error", "red");
			echo $this->color("Prøvde å kjøre:");
			echo $this->color($sql, "green");
			echo $this->color(wordwrap($e->getMessage()), "red");
			echo PHP_EOL;
		}
	}

	private function color($text, $color=null, $bgColor=null) {
		return Yii::app()->cliColor->getColoredString($text . PHP_EOL, $color, $bgColor);
	}

	public function update() {
		$sqlDrop = "DROP DATABASE IF EXISTS `hybrida_dev`;\n";
		$this->executeSql($sqlDrop);
		$this->install();
	}

}