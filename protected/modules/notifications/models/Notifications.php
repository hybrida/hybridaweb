<?php

class Notifications {

	public static function addListener($type, $id, $userID) {
		if (self::isUserAlreadyListening($type, $id, $userID)) {
			return;
		}
		self::addNewListener($type, $id, $userID);
	}

	private static function addNewListener($type, $id, $userID) {
		$sql = "INSERT INTO notification_listener
				(parentType, parentID, userID) VALUES
				(:type, :id, :userID)";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->bindValue("type", $type);
		$stmt->bindValue("id", $id);
		$stmt->bindValue("userID", $userID);
		$stmt->execute();
	}

	private static function isUserAlreadyListening($type, $id, $userID) {
		$where = "parentType = :type AND parentID = :id AND userID = :userID";
		$listenerCount = NotificationListener::model()->count($where, array(
			'type' => $type,
			'id' => $id,
			'userID' => $userID));
		return $listenerCount == 1;
	}

	public static function getListeners($type, $id) {
		$sql = "SELECT userID
				FROM notification_listener
				WHERE parentType = :type AND parentID = :id";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->execute(array(
			'type' => $type,
			'id' => $id	));
		$listenerIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);
		self::appendProfileOwnerToListenerIDs($type, $id, $listenerIDs);
		return $listenerIDs;
	}

	private static function appendProfileOwnerToListenerIDs($type, $id, & $listenerIDs) {
		if ($type == 'profile' && !in_array($id, $listenerIDs)) {
			$listenerIDs[] = $id;
		}
	}

	public static function notify($type, $id, $statusCode, $changedByUserID = null, $commentID = null) {
		$listenerIDs = self::getListeners($type, $id);
		foreach ($listenerIDs as $listenerID) {
			if ($listenerID == $changedByUserID)
				continue;
			$notification = new Notification;
			$notification->parentID = $id;
			$notification->parentType = $type;
			$notification->userID = $listenerID;
			$notification->statusCode = $statusCode;
			$notification->changedByUserID = $changedByUserID;
			$notification->commentID = $commentID;
			$notification->save();
		}
	}

	public static function notifyAndAddListener($type, $id, $statusCode, $changedByUserID = null, $commentID = null) {
		self::addListener($type, $id, $changedByUserID);
		self::notify($type, $id, $statusCode, $changedByUserID, $commentID);
	}

	public static function getAll($userID) {
		return Notification::model()->findAll("userID = ?", array($userID));
	}

	public static function getUnread($userID) {
		$criteria = new CDbCriteria();
		$criteria->compare('userID', $userID);
		$criteria->compare('isRead', 0); // burde stått false istendefor 0, men det funket ikke
		$criteria->order = 'timestamp DESC';
		return Notification::model()->with('changedByUser')->findAll($criteria);
	}

	public static function getRead($userID, $limit) {
		$criteria = new CDbCriteria();
		$criteria->limit = $limit;
		$criteria->compare('userID', $userID);
		$criteria->compare('isRead', true);
		$criteria->order = 'timestamp DESC';
		return Notification::model()->with('changedByUser')->findAll($criteria);
	}

	public static function getMessage($statusCode) {
		switch ($statusCode) {
			case Notification::STATUS_CHANGED:
				return 'gjorde en endring på';
				break;
			case Notification::STATUS_NEW_COMMENT:
				return 'kommenterte på';
				break;
			case Notification::STATUS_FORUM_NEW_REPLY:
				return 'svarte på';
				break;
		}
	}

	public static function getCount($userId) {
		$sql = "SELECT count(DISTINCT parentId, parentType) AS count
					FROM notification
					WHERE userId  = :userId AND
					isRead = 0";
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->bindValue(':userId', $userId);
		$stmt->execute();
		$fetch = $stmt->fetch(PDO::FETCH_ASSOC);
		return $fetch['count'];
	}

}
