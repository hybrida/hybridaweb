<?php

class Notifications {

	public static function addListener($type, $id, $userId) {
		if (self::isUserAlreadyListening($type, $id, $userId)) {
			return;
		}
		self::addNewListener($type, $id, $userId);
	}

	public static function removeListener($type, $id, $userId) {
		Yii::app()->db->createCommand()->update(
			'notification_listener',
			array('isDeleted' => 1),
			'parentType = :type AND parentId = :id AND userId = :userId',
			array(
				'type' => $type,
				'id' => $id,
				'userId' => $userId,
			));
	}

	private static function addNewListener($type, $id, $userID) {
		$sql = "INSERT INTO notification_listener
				(parentType, parentID, userID) VALUES
				(:type, :id, :userID)
				ON DUPLICATE KEY UPDATE isDeleted = 0";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->bindValue("type", $type);
		$stmt->bindValue("id", $id);
		$stmt->bindValue("userID", $userID);
		$stmt->execute();
	}

	private static function isUserAlreadyListening($type, $id, $userID) {
		$where = "parentType = :type AND parentID = :id AND userID = :userID AND isDeleted = 0";
		$listenerCount = NotificationListener::model()->count($where, array(
			'type' => $type,
			'id' => $id,
			'userID' => $userID));
		return $listenerCount == 1;
	}

	public function isListening($type, $id, $userId) {
		return self::isUserAlreadyListening($type, $id, $userId);
	}

	public static function getListeners($type, $id) {
		$sql = "SELECT userID
				FROM notification_listener
				WHERE parentType = :type AND parentID = :id AND isDeleted = 0";
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
			self::insertNotifications(array(
				'parentId' => $id,
				'parentType' => $type,
				'userID' => $listenerID,
				'statusCode' => $statusCode,
				'changedByUserID' => $changedByUserID,
				'commentID' => $commentID,
			));
//			$notification = new Notification;
//			$notification->parentID = $id;
//			$notification->parentType = $type;
//			$notification->userID = $listenerID;
//			$notification->statusCode = $statusCode;
//			$notification->changedByUserID = $changedByUserID;
//			$notification->commentID = $commentID;
//			$notification->save();
		}
	}

	private static function insertNotifications($params) {
		$sql = "INSERT IGNORE INTO `hybrida_dev`.`notification`
				(`parentType`, `parentID`, `userID`,
					`changedByUserID`, `commentID`, `statusCode`)
				VALUES (:parentType, :parentId, :userID,
					:changedByUserID, :commentID, :statusCode);";
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->execute($params);
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
			case Notification::STATUS_NEW_COMMENT:
				return 'kommenterte på';
			case Notification::STATUS_FORUM_NEW_REPLY:
				return 'svarte på';
			case Notification::STATUS_GRIFF_COMMENT:
				return "liker kommentaren din på";
		}
	}

	public static function getCount($userId) {
		$sql = "SELECT count(DISTINCT parentId, parentType, statusCode) AS count
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
