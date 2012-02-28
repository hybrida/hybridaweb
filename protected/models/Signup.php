<?php

Yii::import('bpc.components.*');

/**
 * This is the model class for table "signup".
 *
 * The followings are the available columns in table 'signup':
 * @property integer $eventId
 * @property integer $spots
 * @property string $open
 * @property string $close
 * @property string $signoff
 */
class Signup extends CActiveRecord {

	private $_access;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Signup the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'signup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eventId, spots, open, close', 'required'),
			array('eventId, spots', 'numerical', 'integerOnly' => true),
			array('signoff', 'length', 'max' => 5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('eventId, spots, open, close, signoff', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'event' => array(self::BELONGS_TO, 'Event', 'eventId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'eventId' => 'Event',
			'spots' => 'Spots',
			'open' => 'Open',
			'close' => 'Close',
			'signoff' => 'Signoff',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('eventId', $this->eventId);
		$criteria->compare('spots', $this->spots);
		$criteria->compare('open', $this->open, true);
		$criteria->compare('close', $this->close, true);
		$criteria->compare('signoff', $this->signoff, true);
		$criteria->compare('active', $this->active);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function afterConstruct() {
		$this->_access = new AccessRelation($this);
	}

	public function afterFind() {
		$this->afterConstruct();
	}

	public function setAccess($array) {
		$this->_access->set($array);
	}

	public function getAccess() {
		return $this->_access->get();
	}

	public function afterSave() {
		$this->_access->replace();
	}

	public function addAttender($userId, $addBPC = true) {
		$sql = "INSERT INTO signup_membership 
			( `eventId`, `userId`, `signedOff` )
			VALUES ( :eid, :uid, 'false')
			ON DUPLICATE KEY UPDATE `signedOff` = 'false'";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->bindValue(':eid', $this->eventId);
		$stmt->bindValue(':uid', $userId);
		$stmt->execute();

		if ($addBPC) {
			$this->addBpcAttender($userId);
		}
	}

	private function addBpcAttender($userID) {
		if ($this->isBpc()) {
			BpcCore::addAttending($this->event->bpcID, $userID);
		}
	}

	public function removeAttender($userId) {
		Yii::app()->db->createCommand()
				->update('signup_membership', array('signedOff' => 'true',), 'eventId = :eventId AND userId = :userId', array(
					':eventId' => $this->eventId,
					':userId' => $userId));
		$this->removeBpcAttender($userId);
	}

	private function removeBpcAttender($userID) {
		if ($this->isBpc()) {
			BpcCore::removeAttending($this->event->bpcID, $userID);
		}
	}

	private function isBpc() {
		return $this->event != null && $this->event->bpcID;
	}

	public function removeAllAttenders() {
		Yii::app()->db->createCommand()
				->update('signup_membership', array('signedOff' => 'true'), 'eventId = :eid', array(':eid' => $this->eventId));
	}

	public function getAttendingCount() {
		$sql = "SELECT COUNT(*) as num 
			FROM signup_membership
			WHERE eventId = :eventId
				AND signedOff = 'false'";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);

		$stmt->execute(array(
			':eventId' => $this->eventId,
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		return $data['num'];
	}

	public function getAttenderIDs() {
		$sql = "SELECT userId
			FROM signup_membership
			WHERE eventId = :eventId
				AND signedOff = 'false'
			";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->execute(array(
			':eventId' => $this->eventId,
		));
		return $stmt->fetchAll(PDO::FETCH_COLUMN);
	}

	public function getAttenders() {
		$attenderIDs = $this->getAttenderIDs();
		$attenders = array();
		foreach ($attenderIDs as $userId) {
			$user = User::model()->findByPk($userId);
			if ($user) {
				$attenders[] = $user;
			}
		}
		return $attenders;
	}

	public function isAttending($userId) {
		$sql = "SELECT userId
			FROM signup_membership
			WHERE eventId = :eventId
				AND userId = :userId
				AND signedOff = 'false'";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->execute(array(
			':userId' => $userId,
			':eventId' => $this->eventId,
		));
		$data = $stmt->fetch();
		return !empty($data);
	}

	public function isOpen() {
		return time() > strtotime($this->open) &&
				time() < strtotime($this->close);
	}

	public function hasFreeSpots() {
		return $this->spots > $this->getAttendingCount();
	}

	public function canAttend() {
		return 	$this->isOpen() &&
				$this->hasFreeSpots() &&
				app()->gatekeeper->hasPostAccess('signup', $this->eventId) &&
				app()->gatekeeper->hasPostAccess('event', $this->eventId) &&
				!user()->isGuest;
	}

}