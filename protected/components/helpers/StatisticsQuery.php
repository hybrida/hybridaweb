<?php

class StatisticsQuery {
	public static function newsCount() {
		return News::model()->count();
	}

	public static function newsCountOneMonthBack() {
		$time_from = date("Y-m-d H:i:s", strtotime('-1 month'));
		$time_to   = date("Y-m-d H:i:s", time());

		return News::model()->count(
				"timestamp BETWEEN '".$time_from."' AND '".$time_to."'");
	}

	public static function usersCount() {
		return User::model()->count();
	}
}

?>
