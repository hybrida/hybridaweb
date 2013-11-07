<?php

class TrackGraph extends CComponent {

	private $days;
	private $_models;
	private $_users;

	public function __construct($days) {
		$this->days = $days;
		$this->gatherData();
	}

	private function gatherData() {
		$this->gatherLogData();
		$this->gatherUsers();
	}

	private function gatherLogData() {
		$criteria = new CDbCriteria();
		$criteria->condition = "DATE_ADD(date, INTERVAL :days DAY) > NOW()";
		$criteria->params = array(
			':days' => $this->days,
		);
		$this->_models = TrackerLog::model()->findAll($criteria);
	}

	private function gatherUsers() {
		$this->_users = TrackerUser::model()->with('user')->findAll();
	}

	public function getSeries() {
		$graphs = array();
		foreach ($this->_users as $user) {
			$graph = new TrackerGraph();
			$graph->user = $user->user;
			$graph->color = $user->graph_color;
			$graph->data = array_fill(0, $this->days, 0);
			$graphs[] = $graph;
		}
		foreach ($this->_models as $model) {
			$model_time = strtotime($model->date);
			$current_time = time();
			$time_diff = $current_time - $model_time;
			$days_ago = $this->days - ceil($time_diff / (60*60*24));
			foreach ($this->_users as $key => $user) {
				if ($user->user_id == $model->user_id) {
					$graphs[$key]->data[$days_ago] += $model->work_time;
				}
			}
		}
		$array = array();
		foreach ($graphs as $graph) {
			$array[] = $graph->toArray();
		}
		return CJSON::encode($array);
	}

	public function getHistory() {
		$histories = array();
		foreach ($this->_users as $user) {
			$hist = new UserHistory;
			$hist->user = $user->user;
			foreach ($this->_models as $model) {
				if ($model->user_id == $user->user_id && $this->isLast7days($model)) {
					$hist->hours += $model->work_time;
					$hist->date[] = $model->date;
				}
			}
			$histories[] = $hist->toArray();
		}
		return $histories;
	}

	private function isLast7days($model) {
		$secondsInDay = 60 * 60 * 24;
		$lastWeek = time() - $secondsInDay * 8;
		$today = time() - $secondsInDay;
		$modelTime = strtotime($model->date);
		return $modelTime > $lastWeek && $modelTime < $today;
	}

	public function getDates() {
		$secondsInDay = 60*60*24;
		$startTime = time() - $secondsInDay*($this->days-1);
		$dates = array();
		for ($i = 0; $i < $this->days; $i++) {
			$time = $startTime + $secondsInDay * $i;
			$date = date('d', $time);
			$dates[] = $date;
		}
		return CJSON::encode($dates);
	}

}

class UserHistory extends CComponent {
	public $user;
	public $last7days;
	public $hours = 0;
	public $date = array();

	public function toArray() {
		$out = array(
			'name' => $this->user->fullName,
			'hours' => $this->hours,
			'date' => implode(", ", $this->date),
		);
		return $out;

	}
}

class TrackerGraph extends CComponent {
	public $user;
	public $data = array();
	public $color;

	public function toArray() {
		$out = array(
			"name" => $this->user->fullName,
			'data' => $this->data,
		);
		if ($this->color !== NULL) {
			$out['color'] = "#" . $this->color;
		}
		return $out;
	}
}