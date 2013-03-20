
<?php

class RangePicker extends CWidget {

	public $model = null;
	public $options;
	public $attribute;

	public function init() {
		$this->setDefaultValues();
		$this->readModelValue();
	}

	public function setDefaultValues()
	{
		if (!isset($this->options['value']))
			$this->options['value'] = 0;
		if (!isset($this->options['min']))
			$this->options['min'] = 0;
		if (!isset($this->options['max']))
			$this->options['max'] = 10;
	}

	public function readModelValue()
	{
		$attr = $this->model->getAttributes();
		if (isset($attr->weight))
			$this->options['value'] = $attr[$attribute];
		else if ($this->model instanceof ArticleForm)
		{
			$parentArticle = $this->model->getArticleModel();
			$articleAttr = $parentArticle->getAttributes();
			$this->options['value'] = $articleAttr[$this->attribute];
		}
	}

    public function run() {
        $this->render('rangePicker', $this->options);
    }
}
