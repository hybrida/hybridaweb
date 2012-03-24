<?php

Yii::import('ext.php-calendar.classes.*');

class CalendarController extends Controller {

	public $weekStart = 1;
	public $month = 1;
	public $year = 2000;
	private $calendar;
	private $showDays = array(
		'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag', 'Søndag'
	);

	public function init() {
		$this->publishAssets();
	}

	private function publishAssets() {
		$url = $this->getAssetsDir() . "css/";
		$cs = Yii::app()->getClientScript();
		$am = Yii::app()->getAssetManager();
		$cs->registerCssFile($am->publish($url . 'style.css'));
	}

	private function getAssetsDir() {
		return Yii::getPathOfAlias('ext.php-calendar') . "/assets/";
	}

	private function getConfig() {
		$conf = array();
		$conf['week_start'] = $this->weekStart;
		$conf['show_days'] = $this->showDays;
		return $conf;
	}

	private function setCalendar($year, $month) {
		$this->setDate($year, $month);
		$this->calendar = Calendar::factory($this->month, $this->year, $this->getConfig());
		$this->getEvents();
	}

	private function setDate($year, $month) {
		if ($year === null) {
			$year = date('Y');
		}
		if ($month === null) {
			$month = date('n');
		}
		$this->year = $year;
		$this->month = $month;
	}

	private function getEvents() {
		$from = $this->year . "-" . $this->month . "-01";
		$to = $this->getNextMonthsYear() . "-" . $this->getNextMonth() . "-01";
		$eventList = News::getNewsBetween($from, $to);
		$this->putEvents($eventList);
	}

	private function getNextMonthsYear() {
		if ($this->month == 12)
			return $this->year + 1;
		return $this->year;
	}

	private function getNextMonth() {
		if ($this->month == 12)
			return 1;
		return $this->month + 1;
	}

	private function putEvents($eventList) {
		foreach ($eventList as $event) {
			$this->putEvent($event);
		}
	}

	private function putEvent($event) {
		$time = $event->event->start;
		$timestamp = strtotime($time);
		$event = $this->calendar->event()
				->condition('timestamp', $timestamp)
				->title($event->title)
				->output(Html::link($event->title, array(
					'/news/view',
					'title' => $event->title,
					'id' => $event->id,
				)));
		$this->calendar->attach($event);
	}

	public function actionIndex($year = null, $month = null) {
		$this->setCalendar($year, $month);
		$this->render('ext.php-calendar.views.calendar', array(
			'calendar' => $this->calendar,
		));
	}
	
	public function actionAjax($year = null, $month = null) {
		$this->setCalendar($year, $month);
		$this->renderPartial('ext.php-calendar.views.calendar', array(
			'calendar' => $this->calendar,
		));
	}

}