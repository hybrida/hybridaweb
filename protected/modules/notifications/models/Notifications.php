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
	
	public static function notify($type, $id, $message) {
		$listeners = self::getListeners($type, $id);
		foreach ($listeners as $listener) {
			$notification = new Notification;
			$notification->parentID = $id;
			$notification->parentType = $type;
			$notification->userID = $listener;
			$notification->save();
		}
	}
	
	public function getNotifications($userID) {
		return Notification::model()->findAll("userID = ?", array($userID));
	}
	
}
