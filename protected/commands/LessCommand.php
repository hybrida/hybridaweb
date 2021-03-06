<?php


class LessCommand extends CConsoleCommand {

	private $lessDir;
	private $cssDir;
	private $lessCode;
	private $compiler;

	public function init() {
		$this->lessDir = dirname(Yii::getPathOfAlias("webroot")) . "/style/less/";
		$this->cssDir = dirname(Yii::getPathOfAlias("webroot")) . "/style/css/";

		$this->compiler = Yii::app()->lessCompiler;
	}

	private function getLessFiles() {
		$files = scandir($this->lessDir);
		return array_filter($files, function($el){
			return !($el == "." || $el == "..");
		});
	}

	public function writeMinCss() {
		$files = $this->getLessFiles();
		$cssCode = array();
		foreach ($files as $file) {
			$cssCode[] = $this->compiler->compile($this->lessDir . $file);
		}
		$mainCss = file_put_contents($this->cssDir . "min.css", implode("\n", $cssCode));
	}

	public function writeAllCssFiles() {
		$files = $this->getLessFiles();
		$cssCode = array();
		foreach ($files as $file) {
			$cssName = str_replace(".less", ".css", $file);
			$this->compiler->compileFile($this->lessDir . $file, $this->cssDir . $cssName);
		}
	}

	public function run($args) {
		if (in_array("min", $args)) {
			$this->writeMinCss();
		} elseif (in_array("all", $args)) {
			$this->writeAllCssFiles();
		} else {
			$this->help();
		}
	}

	private function help() {
		$helpText = <<<EOT
HOWTO:
less min:
	Lag _en_ komprimert main.css fil. Denne som brukes i produksjon.
less all:
	Lag en css-fil for alle less-filene. Denne kan brukes i debugging.

EOT;
		echo $helpText;
	}

}
