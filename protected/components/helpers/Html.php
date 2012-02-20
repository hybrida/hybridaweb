<?php

class Html extends CHtml {
	
	public static function dateToString($dateString, $format='medium') {
		$longMonthNames = array(
			'januar','februar','mars','april','mai','juni',
			'juli','august','september','oktober','november',
			'desember'
		);
		$shortMonthNames = array(
			'jan.', 'feb.', "mar.", "apr.","mai","jun.","jul.",
			"aug.","sep.","okt.", "nov.", "des."
		);
		$date = strtotime($dateString);
		$month = date('n');
		if ($format == 'short')
			return date('n.m.Y', $date);
		if ($format == 'medium')
			return date('j. ', $date) . $shortMonthNames[$month] . date(' Y', $date);
		if ($format == 'long')
			return date('j. ', $date) . $longMonthNames[$month] . date(' Y H:i', $date);
		else
			return date($format, $date);
	}
	
}