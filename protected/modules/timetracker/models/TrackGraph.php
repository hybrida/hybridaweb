<?php

class TrackGraph extends CComponent {

	private $_days;
	private $_models;
	private $_users;

	public function __construct($days) {
		$this->_days = $days;
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
			':days' => $this->_days,
		);
		$this->_models = TrackerLog::model()->findAll($criteria);
	}

	private function gatherUsers() {
		$this->_users = TrackerUser::model()->with('user')->findAll();
	}

	public function getData() {
		$graphs = array();
		foreach ($this->_users as $user) {
			$graph = new TrackerGraph();
			$graph->user = $user->user;
			$graph->data = array_fill(0, $this->_days, 0);
			$graphs[] = $graph;
		}
		foreach ($this->_models as $model) {
			$model_time = strtotime($model->date);
			$current_time = time();
			$time_diff = $current_time - $model_time;
			$days_ago = $this->_days - ceil($time_diff / (60*60*24));
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

}

class TrackerGraph extends CComponent {
	public $user;
	public $data = array();

	public function toArray() {
		$out = array(
			"name" => $this->user->fullName,
			'data' => $this->data,
		);
		return $out;
	}
}