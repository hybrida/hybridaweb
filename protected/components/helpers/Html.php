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

        public static function externalLink($text, $url, $htmlOptions=array()){
            $urlStartsWithHttp = preg_match("/^http:\/\//", $url);
            if (!$urlStartsWithHttp) {
                $url = "http://" . $url;
            }
            return CHtml::link($text, $url, $htmlOptions);
        }

	public static function dateToString($dateString, $format='medium') {
		$date = strtotime($dateString);
		$month = date('n', $date);
		if ($format == 'medium')
			return date('j. ', $date) . self::$shortMonthNames[$month - 1] . date(' Y', $date);
		if ($format == 'mediumlong')
			return date('j. ', $date) . self::$longMonthNames[$month - 1] . date(' Y', $date);
		if ($format == 'long')
			return date('j. ', $date) . self::$longMonthNames[$month - 1] . date(' Y H:i', $date);
		else
			return date($format, $date);
	}

	public static function removeSpecialChars($text) {
		$fixedUnderscores = preg_replace('/ /', '-', $text);	// Replace ' ' with '-'
		$lowerCased = mb_strtolower($fixedUnderscores, "UTF-8");
		return preg_replace('/[^a-zæøåA-ZÆØÅ0-9_ -]/s', '', $lowerCased);		// Keep only chosen chars
	}

	public static function getLongMonthNames() {
		return self::$longMonthNames;
	}
	public static function getShortMonthNames() {
		return self::$shortMonthNames;
	}

        public static
                function timeLeftFromUNIXtimespampToString($eventDate){
            $timeLeft = $eventDate - time();
            if ($timeLeft > 60*60*24*30){
                $monthsLeft = floor($timeLeft/(60*60*24*30));
                Html::printTime($monthsLeft,"måned");
            }elseif($timeLeft > 60*60*24){
                $daysLeft = floor($timeLeft/(60*60*24));
                Html::printTime($daysLeft,"dag");
            }elseif($timeLeft > 60*60){
                $hoursLeft = floor($timeLeft/(60*60));
                Html::printTime($hoursLeft,"time");
            }elseif($timeLeft > 60){
                $minutesLeft = floor($timeLeft/60);
                Html::printTime($minutesLeft,"minutt");
            }elseif ($timeLeft > 0){
                echo "Mindre enn ett minutt gjenstår.<br/>Om du skal, bør du raska på";
            }else{
                echo "Har begynt";
            }
        }

        private function printTime($timeLeft,$duration){
            if ($duration=="måned"){
                Html::printPlural($timeLeft,"måned");
            }elseif($duration == "dag"){
                Html::printPlural($timeLeft,"dag");
            }elseif($duration == "time"){
                Html::printPlural($timeLeft,"time");
            }elseif($duration == "minutt"){
                Html::printPlural($timeLeft,"minutt");
            }
        }

       private static function printPlural($timeLeft,$duration){
            if ($timeLeft == 1){
                echo "1 {$duration} gjenstår.";
            }else{
                echo "{$timeLeft} {$duration}er gjenstår.";
            }
        }

        public static function timeLeftFromDateToString($eventDate){ /*
         * Formatet til $eventDate må være på formen
         *
         * YYYYMMDDTTTT
         *
         * der Y er år, M måned, D dag og T 24-tallsklokkeslett
         */
            $year = floor($eventDate/100000000);
            $rest = ($eventDate/100000000 - $year);
            $month = floor($rest*100);
            $rest2 = ($rest*100 - $month);
            $day = floor($rest2*100);
            $rest3 = ($rest2*100 - $day);
            $hour = floor($rest3*100);
            $rest4 = ($rest3*100 - $hour)*100;
            $minute = floor($rest4);
            return Html::timeLeftFromUNIXtimespampToString(mktime($hour, $minute, 00, $month, $day, $year));
        }

	public static function userListByYear($usersByYear) {
		$i = 1;
		$userYear = user()->classYear;
		foreach($usersByYear as $year):
			if (!empty($year)):
				?>
				<ul class="collapsibleList">
				<? if ($i == $userYear): ?>
					<li class="collapsibleListClosed">
				<? else: ?>
					<li class="collapsibleListOpen">
				<? endif ?>
				<h3> <?= ($i <= 5) ? $i . "årskurs" : "Alumni" ?> (<?= count($year) ?>)</h3>
				<ul>
				<?
				foreach ($year as $user):
					?><li class="node">
						<?= CHtml::link(Image::profileTag($user->imageId, 'mini'), $user->viewUrl) ?>
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

	public static function getCompaniesDropDownArray() {
		$companies = app()->db->createCommand()
				->select('companyID, companyName')
				->from('bk_company')
				->order('companyName ASC')
				->queryAll();
		$array = array();
		$array[null] = 'Ingen valgt';
		foreach ($companies as $c) {
			$array[$c['companyID']] = $c['companyName'];
		}
		return $array;
	}

	public static function getSpecializationsDropDownArray() {
		$specs = Specialization::model()->findAll();
		$array = array();
		$array[null] = 'Ingen valgt';
		foreach ($specs as $spec) {
			$array[$spec->id] = $spec->name;
		}
		return $array;
	}

    public static function truncate($string, $length, $omission) {
        if (strlen($string) > $length) {
            return substr($string, 0, $length).$omission;
        } else {
            return $string;
        }
    }
}
