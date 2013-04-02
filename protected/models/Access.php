<?php

class Access {

	const REGISTERED = 2;
	const MEMBER = 3;
	const MALE = 1001;
	const FEMALE = 1002;

	const GROUP_START = 4000;
	const GENDER_START = 1000;
	const GRADUATION_YEAR_START = 2000;
	const SPECIALIZATION_START = 3000;


	public static function toTextArray($accessArray) {
		$outerOrGroup = array();
		foreach ($accessArray as $access) {
			$grouped = Access::groupByType($access);
			$andGroup = array();
			foreach ($grouped as $type => $values) {
				$innerOrGroup = array();
				foreach($values as $value) {
					$innerOrGroup[] = Access::getTypeText($type, $value);
				}
				$andGroup[] = implode('/', $innerOrGroup);
			}
			$outerOrGroup[] = implode(' og ', $andGroup);			
		}
		return $outerOrGroup;
	}

	private static function groupByType($access) {
		$grouped = array();
		foreach ($access as $element) {
			$type = floor($element/1000);
			$grouped[$type][] = $element-$type*1000;
		}
		return $grouped;
	}

	private static function getTypeText($type, $value) {
		switch ($type) {
			case 0:
				$userArray = array(2 => 'Innlogget', 3 => 'Medlem');
				return $userArray[$value];
			case 1:
				$genderArray = array(1 => 'Mann', 2 => 'Kvinne');
				return $genderArray[$value];
			case 2:
				$class = YearConverter::graduationYearToClassYear($value + 2000);
				return $class . ". klasse";
			case 3:
				$spec = Specialization::model()->findByPk($value);
				return $spec->name;
			case 4:
				$group = Groups::model()->findByPk($value);	
				return $group->title;
		}
	}
}
