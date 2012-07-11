<?php

class Notifications {
	public static function addListener($type, $id, $userID) {
		$where = "parentType = :type AND parentID = :id AND userID = :userID";
		$listener = NotificationListener::model()->find($where, array(
			'type' => $type,
			'id' => $id,
			'userID' => $userID,
		));
		
		if ($listener !== null) {
			return;
		}
		$listener = new NotificationListener;
		$listener->parentType = $type;
		$listener->parentID = $id;
		$listener->userID = $userID;
		$listener->save();
	}
	
	public static function getListeners($type, $id) {
		$sql = "SELECT userID
				FROM notification_listener
				WHERE parentType = :type AND parentID = :id";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->execute(array(
			'type' => $type,
			'id' => $id,
		));
		$listenerIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);
		
		return $listenerIDs;
	}
	
	public static function notify($type, $id, $statusCode, $changedByUserID=null) {
		$listeners = self::getListeners($type, $id);
		foreach ($listeners as $listener) {
			if ($listener == $changedByUserID) continue;
			$notification = new Notification;
			$notification->parentID = $id;
			$notification->parentType = $type;
			$notification->userID = $listener;
			$notification->statusCode = $statusCode;
			$notification->changedByUserID = $changedByUserID;
			$notification->save();
		}
	}
	
	public static function notifyAndAddListener ($type, $id, $statusCode, $changedByUserID=null) {
		self::addListener($type, $id, $changedByUserID);
		self::notify($type, $id, $statusCode, $changedByUserID);
	}
	
	public static function getAll($userID) {
		return Notification::model()->findAll("userID = ?", array($userID));
	}
	
	public static function getUnread($userID) {
		$where = "userID = ? AND isRead = ?";
		return Notification::model()->findAll($where, array($userID, false));
	}
	
	public static function getMessage($statusCode) {
		switch ($statusCode) {
			case 0:
				return 'Skribenten har endret noe';
				break;
			case 1:
				return 'Ny kommentar';
				break;
		}
	}
	
}
