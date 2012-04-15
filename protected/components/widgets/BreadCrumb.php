<?php

class BreadCrumb extends CWidget {

	public $links = array();
	public $delimiter = ' / ';
	public $firstCrumb;
	public $options;
	
	public function init() {
		$this->firstCrumb = CHtml::link("Hjem", array('site/index'));
	}

	public function run() {
		if (!empty($this->links)){
			$this->render('breadCrumb');
		}
	}
	
	public function option($opt) {
		if (isset($this->options[$opt])) {
			return $this->options[$opt];
		}
		return false;
	}

}