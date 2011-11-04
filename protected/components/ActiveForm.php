<?php

class ActiveForm extends CActiveForm {

	public function textArea($model, $attribute, $htmlOptions=array()) {

		CHtml::resolveNameID($model, $attribute, $htmlOptions);
		//CHtml::clientChange('change', $htmlOptions);
		if ($model->hasErrors($attribute))
			CHtml::addErrorCss($htmlOptions);
		$text = CHtml::resolveValue($model, $attribute);


		$class = get_class($model);
		$name = $class . "[" . $attribute . "]";

		$this->widget('application.components.widgets.XHeditor', array(
			'language' => 'en', //options are en, zh-cn, zh-tw
			'config' => array(
				'id' => $htmlOptions['id'],
				'name' => $htmlOptions['name'],
				'tools' => 'mini', // mini, simple, full or from XHeditor::$_tools, tool names are case sensitive
				'width' => '70%',
			//see XHeditor::$_configurableAttributes for more
			),
			'contentValue' => $text, // default value displayed in textarea/wysiwyg editor field
			'htmlOptions' => array('rows' => 5, 'cols' => 10), // to be applied to textarea
		));
		return false;
	}

}

?>
