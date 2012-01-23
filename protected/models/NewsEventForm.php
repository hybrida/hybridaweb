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

	public $hasSignup;
	public $hasEvent;
	public $news = array();
	public $event = array();
	public $signup = array();
	private $newsModel;
	private $eventModel;
	private $signupModel;

	public function rules() {
		return array(
			array('hasSignup, hasEvent', 'boolean'),
			array('news[title], news[content]', 'required'),
			array(
				'news[title], news[content], ' .
				'event[start],event[end], event[location], event[title], event[imageId], event[content], ' .
				'signup[spots], signup[open], signup[close], signup[signoff], ' .
				'hasEvent, hasSignup',
				'default'
			),
			array('event[start], event[end], signup[open], signup[close]', 'date',),
		);
	}

	public function attributeLabels() {
		return array(
			'news[title]' => 'Tittel',
			'news[content]' => 'Innhold',
			'event[start]' => 'Start',
			'event[end]' => 'Slutt',
			'event[location]' => 'Location',
//			'event[]' => '',
			'signup[spots]' => 'Antall plasser',
			'signup[open]' => 'Starter',
			'signup[close]' => 'Slutter',
			'signup[signoff]' => 'Tillat avmelding',
			'hasEvent' => 'Dette er en hendelse',
			'hasSignup' => 'Ta med påmelding',
		);
	}

	public function __construct(News $news, $scenario = ' ') {
		parent::__construct($scenario);

		if ($news == null) {
			throw new NullPointerException("Input have to be a valid News model");
		}

		$this->initAllModelsBaseCase();
		$this->initNewsModel($news);
		$this->initFields();
	}

	private function initAllModelsBaseCase() {
		$this->newsModel = new News;
		$this->eventModel = new Event;
		$this->signupModel = new Signup;
	}

	private function initNewsModel($news) {
		$this->newsModel = $news;
		if (!$news->isNewRecord) {
			$this->initEvent();
			$this->initSignup();
		}
	}

	private function initEvent() {
		$news = $this->newsModel;
		if ($news->parentType == "event" && $news->parentId !== null) {
			$this->eventModel = Event::model()->findByPk($news->parentId);
		}
		if (!$this->eventModel) {
			$this->eventModel = new Event;
		}
	}

	private function initSignup() {
		$signup = Signup::model()->findByPk($this->eventModel->primaryKey);
		if ($signup) {
			$this->signupModel = $signup;
		}
	}

	private function initFields() {
		$this->initModelAttributes();
		$this->initAccessFields();
		$this->initHasFields();
	}

	private function initModelAttributes() {
		$this->news = $this->newsModel->attributes;
		$this->event = $this->eventModel->attributes;
		$this->signup = $this->signupModel->attributes;
	}

	private function initAccessFields() {
		$this->news['access'] = $this->newsModel->access;
		$this->event['access'] = $this->eventModel->access;
		$this->signup['access'] = $this->signupModel->access;
	}

	private function initHasFields() {
		$this->hasEvent = (!$this->eventModel->isNewRecord && $this->eventModel->status != Status::DELETED) ? 1 : 0;
		$this->hasSignup = (!$this->signupModel->isNewRecord && $this->signupModel->status != Status::DELETED) ? 1 : 0;
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
			$this->eventModel->status = Status::PUBLISHED;
			$this->eventModel->save();
		} else {
			$this->deleteEventModel();
		}
	}

	private function deleteEventModel() {
		if (!$this->eventModel->isNewRecord) {
			$this->eventModel->status = Status::DELETED;
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
			$this->signupModel->status = Status::PUBLISHED;
			$this->signupModel->save();
		} else {
			$this->deleteSignupModel();
		}
	}

	private function deleteSignupModel() {
		if (!$this->signupModel->isNewRecord) {
			$this->signupModel->status = Status::DELETED;
			$this->signupModel->save();
		}
	}

	public function saveNews() {
		$this->newsModel->setAttributes($this->news);

		if (array_key_exists("access", $this->news)) {
			$this->newsModel->access = $this->news['access'];
		}

		$this->initNewsParent();
		$this->newsModel->save();
	}

	private function initNewsParent() {
		if ($this->hasEvent) {
			$this->newsModel->setParent("event", $this->eventModel->id);
		}
	}

	public function setAttributes($values, $safeOnly = true) {
		foreach ($values as $key => $value) {
			if (isset($this->$key)) {
				$this->$key = $value;
			}
		}
	}

}