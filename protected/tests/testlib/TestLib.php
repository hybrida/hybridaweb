<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestLib
 *
 * @author sigurd
 */
class TestLib {

	public static function truncateDatabase() {
		$sql = "TRUNCATE `access_relations`;
				TRUNCATE `membership_access`;
				TRUNCATE `news`;
				TRUNCATE `signup`;
				TRUNCATE `user_new`;";
		Yii::app()->db->getPdoInstance()->prepare($sql)->execute();
	}
	
	public static function deleteDummyData() {
		self::deleteDummyDataFromNews();
		self::deleteDummyDataFromEvent();
	}
	
	public static function deleteDummyDataFromNews() {
		$sql = "delete from news where 
				timestamp is null 
				or title is null 
				or author is null 
				or content is null
				or title = 'title'
				or title = 'dummy'
				or title = 'TestCase'
				or content = 'TestCase'
				or title = 'NewsEventFormTest'
				";
		$command = Yii::app()->db->createCommand($sql);
		$command->execute();
	}
	
	public static function deleteDummyDataFromEvent() {
		$sql = "delete from event where 
				title is null 
				or title = 'title'
				or title = 'dummy'
				or title = 'TestCase'
				or title = 'NewsEventFormTest'
				or title = 'SPAM'
				or title = ''
				or title = 'jepp'
				";
		$command = Yii::app()->db->createCommand($sql);
		$command->execute();
	}

}