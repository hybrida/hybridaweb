<?php

Yii::import('notifications.models.*');

class NotificationComponentTest extends CTestCase {

	private $comp;

	public function setUp() {
		$this->comp = Yii::app()->notification;
	}

	public function testAddListener() {
		$news = Util::getNews();
		$user = Util::getUser();

		$this->comp->addListener(Type::NEWS, $news->id, $user->id);

		$listeners = Notifications::getListeners(Type::NEWS, $news->id, $user->id);
		$this->assertEquals(1, count($listeners));
	}

}