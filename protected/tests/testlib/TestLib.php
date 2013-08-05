<?php

class TestLib {

	public static function truncateDatabase() {
		$sql = "TRUNCATE `access_relations`;
				TRUNCATE `event`;
				TRUNCATE `membership_access`;
				TRUNCATE `signup_membership`;
				TRUNCATE `news`;
				TRUNCATE `signup`;";
		Yii::app()->db->getPdoInstance()->prepare($sql)->execute();
	}

	public static function deleteDummyData() {
		self::deleteDummyDataFromNews();
		self::deleteDummyDataFromArticle();
	}

	public static function deleteDummyDataFromNews() {
		$sql = "delete from news where
				timestamp is null
				or title is null
				or authorId is null
				or content is null
				or title = 'title'
				or title = 'test'
				or title = 'dummy'
				or title = 'TestCase'
				or content = 'TestCase'
				or title = 'NewsEventFormTest'
				or title Like 'Lipsum%'
				";
		$command = Yii::app()->db->createCommand($sql);
		$command->execute();
	}

	public static function deleteDummyDataFromArticle() {
		$sql = "delete from article where
				title is null
				or title = 'title'
				or title = 'dummy'
				or title = 'TestCase'
				or title = 'NewsEventFormTest'
				or title Like 'Lipsum%'
				";
		$command = Yii::app()->db->createCommand($sql);
		$command->execute();
	}

	public static function trace($name, $value) {
		$len = strlen($name);
		echo "\n\n$name\n";
		for ($i = 0; $i < $len; $i++) {
			echo "=";
		}
		echo "\n";
		print_r($value);
		echo "\n";
	}

}