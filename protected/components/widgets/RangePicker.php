
<?php

class RangePicker extends CWidget {

	public $model = null;
	public $options;
	public $attribute;

	public function init() {
		$this->setDefaultValues();
		$this->fixRange();
		$this->readModelValue();
		$this->clampValue();
		$this->registerCss();
	}

	public function setDefaultValues() {
		if (!isset($this->options['min'])) {
			$this->options['min'] = 0;
		}
		if (!isset($this->options['max'])) {
			$this->options['max'] = 10;
		}
		if (isset($this->options['defaultValue'])) {
			$this->options['value'] = $this->options['defaultValue'];
		} else {
			$this->options['value'] = 0;
		}
	}

	public function fixRange() {
		if ($this->options['min'] > $this->options['max']) {
			$temp = $this->options['min'];
			$this->options['min'] = $this->options['max'];
			$this->options['max'] = $temp;
		}
	}

	public function readModelValue() {
		$attr = $this->model->getAttributes();
		if (isset($attr[$this->attribute])) {
			$this->options['value'] = $attr[$this->attribute];
		}
	}

	public function clampValue() {
		if ($this->options['value'] < $this->options['min']) {
			$this->options['value'] = $this->options['min'];
		}
		if ($this->options['value'] > $this->options['max']) {
			$this->options['value'] = $this->options['max'];
		}
	}

	public function registerCss() {
		$cssFile = '/rangePicker.css';
		$assetPathAlias = 'application.components.widgets.assets';
		$assetManager = Yii::app()->getAssetManager();
		$assetUrl = $assetManager->publish(Yii::getPathOfAlias($assetPathAlias));
		Yii::app()->clientScript->registerCssFile($assetUrl . $cssFile);
	}

	public function run() {
		$this->render('rangePicker', $this->options);
	}

}
