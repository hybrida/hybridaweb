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
	
	public static function getLongMonthNames() {
		return self::$longMonthNames;
	}
	public static function getShortMonthNames() {
		return self::$shortMonthNames;
	}
	
	public static function userListByYear($usersByYear) {
		$i = 1;
		foreach($usersByYear as $year): 
			if (!empty($year)):
				?>
				<ul class="collapsibleList">
				<li><h3> <?= $i ?>. årskurs </h3>
				<ul>
				<?
				foreach ($year as $user): 
					?><li>
						<?= Image::profileTag($user->imageId, 'mini') ?>
						<?= Html::link($user->fullName, array('/profile/info', 'username' => $user->username)) ?>
					</li><?
				endforeach;
				?></ul>
				</li>
				</ul><? 
			endif;
			$i++;
		endforeach;
	}
	
}