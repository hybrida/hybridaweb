<?php

class ActiveForm extends CActiveForm {

	public function textArea($model, $attribute, $htmlOptions=array()) {
		CHtml::resolveNameID($model, $attribute, $htmlOptions);
		$text = CHtml::resolveValue($model, $attribute);

		$this->widget('ext.xheditor.XHeditor', array(
			'language' => 'en', //options are en, zh-cn, zh-tw
			'config' => array(
				'id' => $htmlOptions['id'],
				'name' => $htmlOptions['name'],
				'tools' => 'GStart,Bold,Italic,Underline,GEnd,Separator,GStart,Cut,Copy,Paste,GEnd,Separator,GStart,Blocktag,Removeformat,Separator,List,Source,Fullscreen,GEnd', // mini, simple, full or from XHeditor::$_tools, tool names are case sensitive
				'width' => '130%',
				'height' => '400',
			//see XHeditor::$_configurableAttributes for more
			),
			'contentValue' => $text, // default value displayed in textarea/wysiwyg editor field
			'htmlOptions' => array('rows' => 20, 'cols' => 15), // to be applied to textarea
		));
		return false;
	}

	public function dateField($model, $attribute, $htmlOptions=array()) {
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

	public function accessField($model, $attribute, $htmlOptions=array()) {
		$this->widget('application.components.widgets.AccessField', array(
			'model' => $model,
			'attribute' => $attribute,
		));
	}

}