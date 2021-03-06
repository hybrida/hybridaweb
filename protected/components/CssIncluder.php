<?php

class CssIncluder {

	private static $cssFiles = array();
	private static $lessFiles = array();

	public static function printTags() {
		self::registerDirectory("css", self::$cssFiles);
		$output = "";
		foreach (self::$cssFiles as $file) {
			if (strpos($file, "min.css") !== false) continue;
			$output .= CHtml::tag('link', array(
				'rel' => 'stylesheet',
				'type' => 'text/css',
				'href' => $file,
			)) . PHP_EOL;

		}
		return $output;
	}

	private static function registerDirectory($dir, & $fileList) {
		$styleDir = dirname(Yii::app()->basePath) . "/" . $dir . "/";
		$directoryHandle = opendir($styleDir);
		while ($file = readdir($directoryHandle)) {
			$fullPathName = $styleDir . $file;
			if ($file == "." || $file == ".." || is_dir($fullPathName)) {
				continue;
			}
			$fileList[] = Yii::app()->request->baseUrl . "/" . $dir . "/" . $file;
		}
	}

}