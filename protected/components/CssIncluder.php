<?php

class CssIncluder {

	private static $cssFiles = array();

	public static function printCssTags() {
		self::registerDirectories();
		$output = "";
		foreach (self::$cssFiles as $file) {
			$output .= CHtml::tag('link', array(
				'rel' => 'stylesheet/less',
				'type' => 'text/css',
				'href' => $file,
			)) . PHP_EOL;

		}
		return $output;
	}

	public static function registerDirectories() {
		$dir = "style/less";
		$styleDir = dirname(Yii::app()->basePath) . "/" . $dir . "/";
		$directoryHandle = opendir($styleDir);
		while ($file = readdir($directoryHandle)) {
			$fullPathName = $styleDir . $file;
			if ($file == "." || $file == ".." || is_dir($fullPathName)) {
				continue;
			}
			self::$cssFiles[] = Yii::app()->request->baseUrl . "/" . $dir . "/" . $file;
		}
	}

}