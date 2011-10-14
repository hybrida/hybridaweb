<?php

class ActiveForm extends CActiveForm {

	public function textArea($model, $tablePostName) {
		$this->widget('application.components.widgets.XHeditor', array(
				'language' => 'en', //options are en, zh-cn, zh-tw
				'config' => array(
						'id' => 'facebook'  . rand(0, 100000), // FIXME
						'name' => $tablePostName,
						'tools' => 'mini', // mini, simple, full or from XHeditor::$_tools, tool names are case sensitive
						'width' => '70%',
				//see XHeditor::$_configurableAttributes for more
				),
				'contentValue' => '', // default value displayed in textarea/wysiwyg editor field
				'htmlOptions' => array('rows' => 5, 'cols' => 10), // to be applied to textarea
		));
		return false;
	}

}

?>
