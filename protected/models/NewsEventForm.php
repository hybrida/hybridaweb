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
	public $news;
	public $event;
	public $signup;
	private $newsModel;
	private $eventModel;
	private $signupModel;

	public function __construct(CActiveRecord $model, $scenario=' ') {
		parent::__construct($scenario);

		$this->initModels();
		$this->initModel($model);

		$this->initSignupModel();
		$this->initModelAttributes();
	}

	private function initModels() {
		$this->setDefaultModelValues();
	}

	private function setDefaultModelValues() {
		$this->newsModel = News::model();
		$this->eventModel = Event::model();
		$this->signupModel = Signup::model();
	}

	private function initModel($model) {
		if ($model instanceof Event) {
			$this->setEventModel($model);
		} else if ($model instanceof News) {
			$this->setNewsModel($model);
		} else {
			throw new Exception("Modellen er ikke støttet.  Sendte inn " . get_class($model)
							. ", og dette er hverken en News eller en Event"
			);
		}
	}

	private function setNewsModel(News $news) {
		if ($news == null) {
			throw new Exception("NullPointerException: News kan ikke være null");
		}
		$this->newsModel = $news;
	}

	private function setEventModel(Event $event) {
		if ($event == null) {
			throw new Exception("NullPointerException: Event kan ikke være null");
		}
		$this->eventModel = $event;
	}

	private function initSignupModel() {
		if ($this->eventModel->hasSignup()) {
			$this->signupModel = $this->eventModel->getSignup();
		}
	}

	private function initModelAttributes() {
		$this->news = $this->newsModel->attributes;
		$this->event = $this->eventModel->attributes;
		$this->signup = $this->signupModel->attributes;
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

	public function testInput() {
		?>
		<h1>testInput</h1>
		<pre>
						<strong>news</strong> <? print_r($this->news) ?>
						event: <? print_r($this->event) ?>
						signup: <? print_r($this->signup) ?>
						hasEvent: <? print_r($this->hasEvent) ?>
						hasNews: <? print_r($this->hasNews) ?>
						hasSignup: <? print_r($this->hasSignup) ?>
																																
		</pre>
		<?
	}

}
?>
