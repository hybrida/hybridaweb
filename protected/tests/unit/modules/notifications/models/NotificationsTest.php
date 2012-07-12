y<?php

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
		
		Notifications::notify('news', $news->id, Notification::STATUS_CHANGED);
		$user1Nots = Notifications::getAll($user1->id);
		$user2Nots = Notifications::getUnread($user2->id);
		$user3Nots = Notifications::getAll($user3->id);
		
		$this->assertEquals(1, count($user1Nots));
		$this->assertEquals(1, count($user2Nots));
		$this->assertEquals(0, count($user3Nots));
	}
	
	public function test_viewUrl_theSameAsNewsViewUrl() {
		$news = Util::getNews();
		$user = Util::getUser();
		Notifications::addListener('news', $news->id, $user->id);
		Notifications::notify('news', $news->id, Notification::STATUS_CHANGED);
		$notifications = Notifications::getAll($user->id);
		$this->assertEquals(1, count($notifications));
		$notificationViewUrl = $notifications[0]->viewUrl;
		$this->assertEquals($news->viewUrl, $notificationViewUrl);
	}
	
	public function test_notify_commentIdIsSentAndViewUrlHasChanged() {
		$user1 = Util::getUser();
		$user2 = Util::getUser();
		$news = Util::getNews();
		
		Notifications::addListener('news', $news->id, $user1->id);
		Notifications::addListener('news', $news->id, $user2->id);
		
		Notifications::notify('news', $news->id, Notification::STATUS_CHANGED, $user1->id, 50);
		
		$notifications = Notifications::getUnread($user2->id);
		$this->assertEquals(1, count($notifications), "User didn't get notified");
		
		$notif = $notifications[0];
		$this->assertEquals(50, $notif->commentID);
		
		$newsUrl = $news->viewUrl;
		$notifUrl = $notif->viewUrl;
		$this->assertEquals($newsUrl . "#comment-50", $notifUrl);
	}
	
	
}