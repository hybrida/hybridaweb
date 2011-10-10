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
class NewsForm extends CFormModel {

	public $hasNews;
	public $hasSignup;
	public $hasEvent;
	public $news;
	public $event;
	public $signup;

	public function __construct($scenario = '') {
		parent::__construct($scenario);

		$news = array(
				'title', 'content', 'imageId',
		);

		$event = array(
				'start', 'end', 'location', 'title',
				'imageId', 'content',
		);

		$signup = array(
				'spots',
				'open',
				'close',
				'signoff',
		);
	}

	public function rules() {
		return array(
				array('hasNews, hasSignup, hasEvent', 'boolean'),
				array(
						'news[title], news[content], ' .
						'event[start],event[end], event[location], event[title], event[imageId], event[content], ' .
						'signup[spost], signup[open], signup[close], signup[signoff]',
						'required'
				),
		);
	}

	public function save() {
		if ($this->hasEvent) {
			if ($news->hasEvent()) {
				//Update Event
				$event = new Event($_POST['event']['id']);
				$event->set($_POST['event']);
				$event->update();
			} else {
				// Lag ny Event
				$event = new Event();
				$event->set($_POST['event']);
				$event->push();

				$news->appendEvent($event);
			}

			if ($_POST['isSignup']) {
				if ($event->hasSignup()) {
					// Update Signup
					$signup = new Signup($event->getId());
					$signup->set($_POST['signup']);
					$signup->setActive(true);
					$signup->update();
				} else {
					//Lag ny Signup
					echo __FILE__ . "Lage Signup<pre>";
					$signup = new Signup();
					$signup->setId($event->getID());
					$signup->set($_POST['signup']);
					print_r($signup);
					$signup->push();
				}
			} else {
				if ($event->hasSignup()) {
					// Slette Signup
					$signup = $event->getSignup();
					$signup->setActive(false);
					$signup->update();
				}
			}
		} else {
			if ($news->hasEvent()) {
				// Slette event
				$news->removeEvent();
			}
		}

		$news->update();
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
