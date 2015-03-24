<?php

class PollForm extends CFormModel {

	private $_poll;
	public $ownerId;
	public $title;
    public $status;
    public $public;

	public function __construct(Poll $poll, $scenario = '') {
		parent::__construct($scenario);

		if ($poll == null) {
			throw new NullPointerException("pollinput was null");
		}

		$this->_poll = $poll;
		$this->initAttributes();
	}

	private function initAttributes() {
		$this->title = $this->_poll->title;
        $this->status = $this->_poll->status;
        $this->public = $this->_poll->public;
	}

	public function save() {
		$this->setPollAttributes();
		$this->_poll->purify();
		$this->_poll->save();
	}

	private function setPollAttributes() {
		$this->_poll->setAttributes(array(
			'title' => $this->title,
            'status' => $this->status,
            'public' => $this->public,
        ));
	}

	public function getPollModel() {
		return $this->_poll;
	}

	public function setAttributes($values, $safeOnly = false) {
		parent::setAttributes($values, $safeOnly);
	}

}
