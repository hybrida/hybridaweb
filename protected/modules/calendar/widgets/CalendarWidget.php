<?php

Yii::import('calendar.components.*');

class CalendarWidget extends CWidget {

	public $size = "small";
	public $weekStart = 1;
	public $month = null;
	public $year = null;
	private $calendar;
	private $showDaysLong = array(
		'Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag'
	);
	private $showDaysShort = array(
		"S", "M", "T", "O", "T", "F", "L",
	);

	private function publishAssets($name) {
		$url = $this->getAssetsDir() . "css/";
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cs->registerCssFile($am->publish($url . "$name.css"));
	}

	private function getAssetsDir() {
		return Yii::getPathOfAlias('calendar') . "/assets/";
	}

	private function getConfig() {
		$conf = array();
		$conf['week_start'] = $this->weekStart;
		$conf['show_days'] = ($this->size == "big") ? $this->showDaysLong : $this->showDaysShort;
		return $conf;
	}

	private function initCalendar() {
		$this->initDate();
		$this->calendar = Calendar::factory($this->month, $this->year, $this->getConfig());
		$this->calendar->standard("today");
		$this->getEvents();
	}

	private function initDate() {
		if ($this->year === null) {
			$this->year = date('Y');
		}
		if ($this->month === null) {
			$this->month = date('n');
		}
	}

	private function getEvents() {
		$from = $this->getStartOfWeek($this->year, $this->month, 1);
		$to = $this->getEndOfWeek($this->getNextMonthsYear(), $this->getNextMonth(), 1);
		$newsList = News::getNewsBetween($from, $to);
		$this->putNewsList($newsList);
	}

	private function getStartOfWeek($year, $month, $day) {
		$dayOfWeek = $this->getDayOfWeek($year, $month, $day);
		return $this->addDaysAndConvertToString($year, $month, $day,  -$dayOfWeek);
	}

	private function getEndOfWeek($year, $month, $day) {
		$dayOfWeek = $this->getDayOfWeek($year, $month, $day);
		return $this->addDaysAndConvertToString($year, $month, $day, 7 - $dayOfWeek);
	}

	private function getDayOfWeek($year, $month, $day) {
		$fromTime = mktime(0, 0, 0, $month, $day, $year);
		$dayOfWeek = date('w', $fromTime)-1;
		return ($dayOfWeek == 0) ? 7 : $dayOfWeek;
	}

	private function addDaysAndConvertToString($year, $month, $day, $days) {
		$newTime = mktime(0, 0, 0, $month, $day + $days, $year); 
		return date('Y-m-d', $newTime);
	}


	private function putNewsList($newsList) {
		foreach ($newsList as $news) {
			if (Yii::app()->gatekeeper->hasPostAccess('news', $news->id)) {
				$this->putNews($news);
			}
		}
	}

	private function putNews($news) {
		$time = $news->event->start;
		$timestamp = strtotime($time);
		$news = $this->calendar->event()
				->condition('timestamp', $timestamp)
				->title($news->title)
				->output($news->viewUrl);
		$this->calendar->attach($news);
	}

	public function getNextMonthsYear() {
		if ($this->month == 12)
			return $this->year + 1;
		return $this->year;
	}

	public function getNextMonth() {
		if ($this->month == 12)
			return 1;
		return $this->month + 1;
	}

	public function getPrevMonthsYear() {
		if ($this->month == 1)
			return $this->year - 1;
		return $this->year;
	}

	public function getPrevMonth() {
		if ($this->month == 1)
			return 12;
		return $this->month - 1;
	}

	public function init() {
		if ($this->size == "small") {
			$this->publishAssets("widget");
		}
		$this->initCalendar();
	}

	public function run() {
		$view = "small";
		if ($this->size == "big") {
			$view = "big";
		}
		$this->render("calendar.views.default." . $view, array(
			'calendar' => $this->calendar,
		));
	}

	public function createUrl($route, $params) {
		return Yii::app()->createUrl($route, $params);
	}

}
