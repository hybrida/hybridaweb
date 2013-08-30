<?php

class StyleIncluder {

	private static $cssFiles = array();
	private static $lessFiles = array();

	public static function printCssTags() {
		self::registerDirectory("style/css", self::$cssFiles);
		$output = "";
		foreach (self::$cssFiles as $file) {
			$output .= CHtml::tag('link', array(
				'rel' => 'stylesheet',
				'type' => 'text/css',
				'href' => $file,
			)) . PHP_EOL;

		}
		return $output;
	}

	public static function printLessTags() {
		self::registerDirectory("style/less", self::$lessFiles);
		$output = "";
		foreach (self::$lessFiles as $file) {
			$output .= CHtml::tag('link', array(
				'rel' => 'stylesheet/less',
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