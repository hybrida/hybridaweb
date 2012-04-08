<?php

class DefaultController extends Controller {

	public function actionIndex($year = null, $month = null) {
		$this->render('index', array(
			'year' => $year,
			'month' => $month,
		));
	}

	public function actionAjax($year = null, $month = null) {
		$this->renderPartial('index', array(
			'year' => $year,
			'month' => $month,
		));
	}

	public function actionWidget($year = null, $month = null) {
		$this->render('widget', array(
			'year' => $year,
			'month' => $month,
		));
	}

	public function actionWidgetAjax($year = null, $month = null) {
		$this->widget('calendar.widgets.CalendarWidget', array(
			'year' => $year,
			'month' => $month,
		));
	}

}
