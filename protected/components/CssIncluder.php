<?php

class CssIncluder {

	public static function getCssTagsFromStyleDirectory() {
		$output = "";
		$styleDir = dirname(Yii::app()->basePath) . "/style/";
		$directoryHandle = opendir($styleDir);
		while ($file = readdir($directoryHandle)) {
			if ($file == "." || $file == "..")
				continue;
			$output .= CHtml::cssFile(Yii::app()->baseUrl . "/style/" . $file) . PHP_EOL;
		}
		return $output;
	}

}