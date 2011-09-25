<?php

class LangBox extends CWidget {

	public function run() {
		$data = array();
		$data['currentLang'] = Yii::app()->language;
		$this->render('langBox', $data);
	}

}

?>