<?php

Yii::import('notifications.models.*');

class NotificationsTest extends CTestCase {

	public function test_AddListener_addDuplicates_addOnlyOnce() {
		Notifications::addListener('profile', 381, 381);
		Notifications::addListener('profile', 381, 391);
		Notifications::addListener('profile', 381, 391);
		Notifications::addListener('profile', 381, 391);
		
		$listeners = array(381, 391);
		
		$this->assertEquals($listeners, Notifications::getListeners('profile', 381));
	}
	
	public function test_addListener_addNewUser() {
		$user = Util::getUser();
		Notifications::addListener('profile', $user->id, $user->id);
		
		$this->assertEquals(array($user->id), Notifications::getListeners('profile', $user->id));
	}
	
	public function test_notify_allListenersAreNotified() {
		$user1 = Util::getUser();
		$user2 = Util::getUser();
		$user3 = Util::getUser();
		
		$news = Util::getNews();
		
		Notifications::addListener('news', $news->id, $user1->id);
		Notifications::addListener('news', $news->id, $user2->id);
		
		Notifications::notify('news', $news->id, 'Nå har noe endra seg vettu');
		$user1Nots = Notifications::getNotifications($user1->id);
		$user2Nots = Notifications::getNotifications($user2->id);
		$user3Nots = Notifications::getNotifications($user3->id);
		
		$this->assertEquals(1, count($user1Nots));
		$this->assertEquals(1, count($user2Nots));
		$this->assertEquals(0, count($user3Nots));
	}
	
}