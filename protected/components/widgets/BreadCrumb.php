<?php

class BreadCrumb extends CWidget {

	public $links = array();
	public $delimiter = ' / ';
	public $firstCrumb;
	public $options = array();
	private $defaults = array();

	public function init() {
		$this->firstCrumb = CHtml::link("Hjem", "/" . Yii::app()->baseUrl);
	}

	public function run() {
		if (!empty($this->links)) {
			$this->render('breadCrumb');
		}
	}

	public function option($opt) {
		if (isset($this->options[$opt])) {
			return $this->options[$opt];
		} else if (isset($this->defaults[$opt])) {
			return $this->defaults[$opt];
		}
		return false;
	}
	
	public function link($title, $urlWithOptions) {
		$htmlOptions = array();
		if (is_array($urlWithOptions) && isset($urlWithOptions['htmlOptions'])) {
			$htmlOptions = $urlWithOptions['htmlOptions'];
			unset($urlWithOptions['htmlOptions']);
		}
		return CHtml::link($title, $urlWithOptions, $htmlOptions);
		
	}

}
