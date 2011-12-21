<?php

class GateKeeper {
	private static $userId;
	private static $access;
	private static $isGuest;

	private static function init() {
		self::$isGuest = Yii::app()->user->isGuest;
		self::initLoggedOut();
		self::initLoggedInn();
	}

	private static function initLoggedOut() {
		if (self::$isGuest) {
			self::$userId = 1;
			self::$access = array();
		}
	}

	private static function initLoggedInn() {
		if (!self::$isGuest) {
			self::$userId = Yii::app()->user->id;
			self::$access = Yii::app()->user->access;
		}
	}

	public static function hasAccess($type, $id) {
		self::init();
		$accessRelation = new AccessRelation($type, $id);
		$access = $accessRelation->get();
		foreach ($access as $ac) {
			if (!in_array($ac, self::$access)) {
				return false;
			}
		}
		return true;
	}
}