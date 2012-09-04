<?php

class CssIncluder {

	public static function getCssTagsFromStyleDirectory() {
		$output = "";
		$styleDir = dirname(Yii::app()->basePath) . "/style/";
		$directoryHandle = opendir($styleDir);
		while ($file = readdir($directoryHandle)) {
			$fullPathName = $styleDir . $file;
			if ($file == "." || $file == ".." || is_dir($fullPathName)) {
				continue;
			}
			$output .= CHtml::cssFile(Yii::app()->baseUrl . "/style/" . $file) . PHP_EOL;
		}
		return $output;
	}

}