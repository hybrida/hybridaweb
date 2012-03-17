<?php

class Html extends CHtml {
	private static $longMonthNames = array(
			'januar','februar','mars','april','mai','juni',
			'juli','august','september','oktober','november',
			'desember'
		);
	private static $shortMonthNames = array(
			'jan.', 'feb.', "mar.", "apr.","mai","jun.","jul.",
			"aug.","sep.","okt.", "nov.", "des."
		);
	
	public static function dateToString($dateString, $format='medium') {
		$date = strtotime($dateString);
		$month = date('n', $date);
		if ($format == 'short')
			return date('n.m.Y', $date);
		if ($format == 'medium')
			return date('j. ', $date) . self::$shortMonthNames[$month - 1] . date(' Y', $date);
		if ($format == 'long')
			return date('j. ', $date) . self::$longMonthNames[$month - 1] . date(' Y H:i', $date);
		else
			return date($format, $date);
	}
	
	public static function removeSpecialChars($text) {
		return preg_replace('/[^a-zæøåA-ZÆØÅ0-9_ -]/s', '', $text);
	}
	
}