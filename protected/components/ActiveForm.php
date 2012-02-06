<?php

class ActiveForm extends CActiveForm {

	public function textArea($model, $attribute, $htmlOptions = array()) {
		$xheditor = isset($htmlOptions['xheditor']) ? $htmlOptions['xheditor'] : false;
		if ($xheditor) {
			$this->renderXHeditor($model, $attribute, $htmlOptions);
		} else {
			return CHtml::activeTextArea($model, $attribute, $htmlOptions);
		}
	}
	
	private function getWidthHeight($htmlOptions) {
		$width = isset($htmlOptions['width']) ? $htmlOptions['width'] : "100%";
		$height = isset($htmlOptions['height']) ? $htmlOptions['height'] : "100%";
		return array($width, $height);
	}

	private function renderXHeditor($model, $attribute, $htmlOptions = array()) {

		CHtml::resolveNameID($model, $attribute, $htmlOptions);
		$text = CHtml::resolveValue($model, $attribute);
		list($width, $height) = $this->getWidthHeight($htmlOptions);
		$this->widget('ext.xheditor.XHeditor', array(
			'language' => 'en', //options are en, zh-cn, zh-tw
			'config' => array(
				'id' => $htmlOptions['id'],
				'name' => $htmlOptions['name'],
				'tools' => 'GStart,Bold,Italic,Underline,GEnd,Separator,GStart,Cut,Copy,Paste,GEnd,Separator,GStart,Blocktag,Removeformat,Separator,List,Source,Fullscreen,GEnd', // mini, simple, full or from XHeditor::$_tools, tool names are case sensitive
				'width' => $width,
				'height' => $height,
			//see XHeditor::$_configurableAttributes for more
			),
			'contentValue' => $text, // default value displayed in textarea/wysiwyg editor field
			'htmlOptions' => array('rows' => 20, 'cols' => 15), // to be applied to textarea
		));
	}

	public function dateField($model, $attribute, $htmlOptions = array()) {
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker', array(
			'model' => $model,
			'attribute' => $attribute,
			'options' => array(
				'dateFormat' => "yy-mm-dd",
				'timeFormat' => "hh:mm:ss",
				'stepMinute' => 5,
				'stepHour' => 1,
			),
		));
	}

	public function accessField($model, $attribute, $htmlOptions = array()) {
		$this->widget('application.components.widgets.AccessField', array(
			'model' => $model,
			'attribute' => $attribute,
		));
	}

}