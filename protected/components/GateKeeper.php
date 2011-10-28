<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GateKeeper
 *
 * @author sigurd
 */
class GateKeeper {

	private static  $userId;
	private static $access;
	private static $pdo;
	private static $isGuest;

	private static function init() {
		self::$isGuest = Yii::app()->user->isGuest;
		self::$userId = 1;
		self::$access = array();

		if ( ! self::$isGuest) {
			self::$userId = Yii::app()->user->id;
			self::$access = Yii::app()->user->access;
		}
		self::$pdo = Yii::app()->db->getPdoInstance();
		
	}

	public static function hasAccess($type, $id) {
		self::init();

		$accessRelation = new AccessRelation($type, $id);
		$access = $accessRelation->get();
		foreach ($access as $ac) {
			if (! in_array($ac, self::$access)) {
				return false;				
			}
		}
		
		return true;
		
		
	}


}
