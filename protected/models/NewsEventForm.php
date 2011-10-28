<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsForm
 *
 * @author sigurd
 */
class NewsEventForm extends CFormModel {

	public $hasNews;
	public $hasSignup;
	public $hasEvent;
	public $news = array();
	public $event = array();
	public $signup = array();
	private $newsModel;
	private $eventModel;
	private $signupModel;

	public function __construct($model, $scenario=' ') {
		parent::__construct($scenario);

		if ($model instanceof News) {
			$this->newsModel = $model;
		} else if ($model instanceof Event) {
			$this->eventModel = $model;
		}
	}

	public function rules() {
		return array(
				array('hasNews, hasSignup, hasEvent', 'boolean'),
				array(
						'news[title], news[content], ' .
						'event[start],event[end], event[location], event[title], event[imageId], event[content], ' .
						'signup[spots], signup[open], signup[close], signup[signoff]',
						'default'
				),
				array('event[start], event[end], signup[open], signup[close]', 'date',),
				array('signup[spots]', 'required'),
		);
	}

	public function getNewsModel() {
		return $this->newsModel;
	}

	public function getEventModel() {
		return $this->eventModel;
	}

	public function getSignupModel() {
		return $this->signupModel;
	}

	public function save() {
		$this->saveEvent();
		$this->saveSignup();
		$this->saveNews();
	}

	public function saveEvent() {
		
	}

	public function saveSignup() {
		
	}

	public function saveNews() {
		if ($this->hasNews) {
			$this->newsModel->setAttributes($this->news);
			try {
				if (array_key_exists("access", $this->news)) {
					$this->newsModel->setAccess($this->news['access']);
				}
			} catch (InvalidArgumentException $e) {
				;
			}
			$this->newsModel->save();
			$this->saveNewsParent();
		}
	}

	public function saveNewsParent() {
		
	}

	public function setAttributes($values) {
		foreach ($values as $key => $value) {
			if (isset($this->$key)) {
				$this->$key = $value;
			}
		}
	}

	/*
	 * UTESTET DEL AV KODEN!!
	 * LAGET 20. oktober 2011
	 * SLETT OM DET ER GAMMELT
	 * 
	  public function save() {
	  $this->saveEvent();
	  $this->saveSignup();
	  $this->saveNews();
	  }

	  private function saveEvent() {
	  if ($this->hasEvent) {
	  $this->eventModel->attributes = $this->event;
	  $this->eventModel->save();
	  }
	  }

	  private function saveSignup() {


	  if ($this->hasSignup) {
	  $this->signupModel->attributes = $this->signup;
	  $this->signupModel->id = $this->eventModel->id;
	  }
	  }

	  private function saveNews() {
	  if ($this->hasNews) {
	  $this->NewsModel->attributes = $this->news;
	  $this->newsModel->save();
	  $this->saveNewsParent();
	  }
	  }

	  private function saveNewsParent() {
	  if ($this->hasEvent) {
	  $this->newsModel->parentId = $this->eventModel->id;
	  $this->newsModel->parentType = "event";
	  } else if (!$this->hasEvent && $this->newsModel->parentType == "event") {
	  $this->newsModel->parentId = null;
	  $this->newsModel->parentType = null;
	  }
	  }

	 */

	public function printFields() {
		?> 
Felter for NewsEventForm
news: <? print_r($this->news) ?> 
event: <? print_r($this->event) ?> 
signup: <? print_r($this->signup) ?> 
hasEvent: <? print_r($this->hasEvent) ?> 
hasNews: <? print_r($this->hasNews) ?> 
hasSignup: <? print_r($this->hasSignup) ?> 
		<?
	}

}
