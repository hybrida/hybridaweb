<?php

class Html extends CHtml {
	
	public static function dateToString($dateString, $format='medium') {
		$date = strtotime($dateString);
		if ($format == 'short')
			return date('d.m.Y', $date);
		if ($format == 'medium')
			return date('d. M Y', $date);
		if ($format == 'long')
			return date('D j. F Y', $date);
		else
			return date($format, $date);
	}
	
}