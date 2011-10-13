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

	public function __construct($scenario = '', $news, $event) {
		parent::__construct($scenario);
		
		$this->updateModels();
		
		$this->newsModel = News::model();
		$this->eventModel = Event::model();
		$this->signupModel = Signup::model();
	}
	
	private function updateModels(News $news, Event $event) {
		if ($news == null) {
			throw new Exception("News er null");
		} else if ($event == null) {
			throw new Exceptin("Event er null");
		} 
		
		$this->eventModel = $event;
		$this->newsModel = $news;
		
		$this->news = $this->newsModel->attributes;
		$this->event = $this->eventModel->attributes;
		
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
				array('event[start], event[end], signup[open], signup[close]','date',),
				array('signup[spots]','required'),
		);
	}

	public function save() {
		
		if ($this->hasEvent) {
			$this->eventModel->attributes = $this->event;
			$this->eventModel->save();
			
			if ($this->hasSignup) {
				$this->signupModel->attributes = $this->signup;
				$this->signupModel->id = $this->eventModel->id;
			}
			
		}
		if ($this->hasNews) {
			$this->NewsModel->attributes = $this->news;
			$this->newsModel->save();
			if ($this->hasEvent) {
				$this->newsModel->parentId = $this->eventModel->id;
				$this->newsModel->parentType = "event";
			} else if (! $this->hasEvent && $this->newsModel->parentType == "event") {
				$this->newsModel->parentId = null;
				$this->newsModel->parentType = null;				
			}
		}

		
		
	}
	
	public function testInput() {
		?>
		<h1>testInput</h1>
		<pre>
		<strong>news</strong> <?print_r($this->news)?>
		event: <? print_r($this->event)?>
		signup: <? print_r($this->signup)?>
		hasEvent: <? print_r($this->hasEvent)?>
		hasNews: <? print_r($this->hasNews)?>
		hasSignup: <? print_r($this->hasSignup)?>
						
		</pre>
		<?
	}

}

?>
