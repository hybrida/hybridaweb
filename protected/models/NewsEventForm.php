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

	public $hasNews = 0;
	public $hasSignup = 0;
	public $hasEvent = 0;
	public $news = array();
	public $event = array();
	public $signup = array();
	private $newsModel;
	private $eventModel;
	private $signupModel;

	public function __construct($model, $scenario=' ') {
		parent::__construct($scenario);

		if ($model == null) {
			throw new NullPointerException("Input have to be a valid News or Event-model");
		}

		$this->initModel($model);
		$this->initFields();
	}

	private function initModel($model) {
		$this->initAllModelsBaseCase();
		if ($model instanceof News) {
			$this->initNewsModel($model);
		} else if ($model instanceof Event) {
			$this->initEventModel($model);
		}
	}

	private function initAllModelsBaseCase() {
		$this->newsModel = new News;
		$this->eventModel = new Event;
		$this->signupModel = new Signup;
	}

	private function initNewsModel($model) {
		if (!$model->isNewRecord) {
			if ($model->parentType == "event" && $model->parentId !== null) {
				$this->eventModel = Event::model()->findByPk($model->parentId);
			}
		}
		$this->newsModel = $model;
	}

	private function initEventModel($model) {
		if (!$model->isNewRecord) {
			// Find News if there exists a news with parentId = this->id and parentType = event
			$sql = "SELECT * FROM news WHERE parentType = 'event' AND parentId = :eventId";
			$news = News::model()->findBySql($sql, array(":eventId" => $model->id));
			if ($news) {
				$this->newsModel = $news;
			}
		}
		$this->eventModel = $model;
	}

	private function initFields() {
		$this->news = $this->newsModel->attributes;
		$this->event = $this->eventModel->attributes;
		$this->signup = $this->signupModel->attributes;


		$this->initAccessFields();
	}

	private function initAccessFields() {
		$this->news['access'] = $this->newsModel->access;
		$this->event['access'] = $this->eventModel->access;
		$this->signup['access'] = $this->signupModel->access;
	}

	public function rules() {
		return array(
			array('hasNews, hasSignup, hasEvent', 'boolean'),
			array(
				'news[title], news[content], ' .
				'event[start],event[end], event[location], event[title], event[imageId], event[content], ' .
				'signup[spots], signup[open], signup[close], signup[signoff], ' .
				'hasEvent, hasNews, hasSignup',
				'default'
			),
			array('event[start], event[end], signup[open], signup[close]', 'date',),
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
		if (Yii::app()->user->isGuest) {
			throw new CHttpException("Du må være logget inn for å lage en nyhet");
		}
		$this->saveEvent();
		$this->saveSignup();
		$this->saveNews();
	}

	public function saveEvent() {
		if ($this->hasEvent) {
			$this->eventModel->setAttributes($this->event);
			if (array_key_exists("access", $this->event)) {
				$this->eventModel->access = $this->event['access'];
			}
			$this->eventModel->save();
		}
	}

	public function saveSignup() {
		if ($this->hasSignup && $this->hasEvent) {
			$this->signupModel->setAttributes($this->signup);
			if (array_key_exists("access", $this->signup)) {
				$this->signupModel->access = $this->signup['access'];
			}
			$this->signupModel->eventId = $this->eventModel->id;
			$this->signupModel->save();
		}
	}

	public function saveNews() {
		if ($this->hasNews) {
			$this->newsModel->setAttributes($this->news);

			if (array_key_exists("access", $this->news)) {
				$this->newsModel->access = $this->news['access'];
			}

			$this->initNewsParent();
			$this->newsModel->save();
		}
	}

	private function initNewsParent() {
		if ($this->hasEvent) {
			$this->newsModel->setParent("event", $this->eventModel->id);
		}
	}

	public function setAttributes($values, $safeOnly=true) {
		foreach ($values as $key => $value) {
			if (isset($this->$key)) {
				$this->$key = $value;
			}
		}
	}

	public function printFields() {
		?> 
		<pre>
						Felter for NewsEventForm
						news: <? print_r($this->news) ?> 
						event: <? print_r($this->event) ?> 
						signup: <? print_r($this->signup) ?> 
						hasEvent: <? echo ($this->hasEvent) ?> 
						hasNews: <? print_r($this->hasNews) ?> 
						hasSignup: <? print_r($this->hasSignup) ?> 
		</pre>
		<?
	}
	
}

