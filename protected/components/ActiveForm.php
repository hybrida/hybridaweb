<?php

class ActiveForm extends CActiveForm {

	public function richTextArea($model, $attribute, $htmlOptions = array()) {
		list($width, $height) = $this->getWidthHeight($htmlOptions);
		$this->widget('ext.editMe.ExtEditMe', array(
			'model' => $model,
			'attribute' => $attribute,
			'htmlOptions' => $htmlOptions,
			'width' => $width,
			'height' => $height,
			'autoLanguage' => false,
			'toolbar' => array(
				array('Bold', 'Italic', 'Underline',),
				array('Cut', 'Copy', 'Paste'),
				array('Link', 'Unlink'),
				array('Format', 'RemoveFormat'),
				array('Undo', 'Redo'),
				array('Source', 'Preview', 'Maximize'),
			),
		));
	}

	private function getWidthHeight($htmlOptions) {
		$width = isset($htmlOptions['width']) ? $htmlOptions['width'] : "98%";
		$height = isset($htmlOptions['height']) ? $htmlOptions['height'] : "25em";
		return array($width, $height);
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
			'htmlOptions' => $htmlOptions,
		));
	}

	public function accessField($model, $attribute, $htmlOptions = array()) {
		$this->widget('application.components.widgets.AccessField', array(
			'model' => $model,
			'attribute' => $attribute,
		));
	}

}