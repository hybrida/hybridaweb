<?php


class LessCommand extends CConsoleCommand {

	private $lessDir;
	private $cssDir;
	private $lessCode;
	private $styleDir;
	private $compiler;

	public function init() {
		$this->lessDir = dirname(Yii::getPathOfAlias("webroot")) . "/style/less/";
		$this->cssDir = dirname(Yii::getPathOfAlias("webroot")) . "/style/css/";
		$this->styleDir = dirname(Yii::getPathOfAlias("webroot")) . "/style/";
		$this->compiler = Yii::app()->lessCompiler;
		$this->getLessCode();
	}

	public function getLessCode() {
		$files = scandir($this->lessDir);
		$files = array_filter($files, function($el){
			return !($el == "." || $el == "..");
		});
		$cssCode = array();
		foreach ($files as $file) {
			$cssCode[] = $this->compiler->compile($this->lessDir . $file);
		}

		$mainCss = file_put_contents($this->styleDir . "main.css", implode("\n", $cssCode));
	}

	public function run($args) {
		cdebug($args);
	}

}