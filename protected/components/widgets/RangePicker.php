
<?php

class RangePicker extends CWidget {

	public $model = null;
	public $attribute;
	public $value;

	public function init() {
		$value = 0;
	}


    public function run() {
        $this->render('rangePicker');
    }
}
