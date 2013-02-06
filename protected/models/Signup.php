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

		$news = $this->getNews();
		if ($news) {
			$array = array('uID' => $userId);
			$sql = "SELECT postEvents FROM fb_user WHERE userId = :uID";
			$query = Yii::app()->db->getPdoInstance()->prepare($sql);
			$query->execute($array);
			$result = $query->fetch(PDO::FETCH_ASSOC);
			if ($result['postEvents'] == true) {
				// Facebook-intregrasjon fungerer ikke.
				// Derfor dropper vi denne for å ikke forsinke
				// påmeldingen.

				// $this->pushToFacebook($news->absoluteUrl);
			}
		}

		if ($addBPC) {
			$this->addBpcAttender($userId);
		}
	}

	public function addAnonymousAttender($firstName, $lastName, $email) {
		$sm = SignupMembershipAnonymous::model()->find("eventId = ? AND email = ?", array(
			$this->eventId, $email,
		));
		if ($sm === null) {
			$sm = new SignupMembershipAnonymous();
		}

		$sm->firstName = $firstName;
		$sm->lastName = $lastName;
		$sm->email = $email;
		$sm->eventId = $this->eventId;
		$sm->save();
		return $sm;
	}

	public function pushToFacebook($eventId) {
		$fb = new Facebook;
		$fb->setAttending($eventId);
	}

	public function getNews() {
		return News::model()->find("parentId = ? AND parentType = 'event'", array(
			$this->eventId,
		));
	}

	private function addBpcAttender($userID) {
		if ($this->isBpcEvent()) {
			BpcCore::addAttending($this->event->eventCompany->bpcID, $userID);
		}
	}

	public function removeAttender($userId) {
		if (!$this->signoff) return;
		Yii::app()->db->createCommand()
			->update('signup_membership', array('signedOff' => 'true',), 'eventId = :eventId AND userId = :userId', array(
				':eventId' => $this->eventId,
				':userId' => $userId));
		$this->removeBpcAttender($userId);
	}

	private function removeBpcAttender($userID) {
		if ($this->isBpcEvent()) {
			BpcCore::removeAttending($this->event->eventCompany->bpcID, $userID);
		}
	}

	private function isBpcEvent() {
		return $this->event != null && $this->event->isBpcEvent();
	}

	public function removeAllAttenders() {
		Yii::app()->db->createCommand()
			->update('signup_membership', array('signedOff' => 'true'), 'eventId = :eid', array(':eid' => $this->eventId));
		Yii::app()->db->createCommand()
			->update('signup_membership_anonymous', array('signedOff' => 'true'), 'eventId = :eid', array(':eid' => $this->eventId));
	}

	public function getAttendingCount() {
		return $this->getRegisteredAttendingCount() + $this->getAnonymousAttendingCount();
	}

	public function getRegisteredAttendingCount() {
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

	public function getAnonymousAttendingCount() {
		return SignupMembershipAnonymous::model()->count("signedOff = 'false' AND eventId = ?", array(
			$this->eventId,
		));
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

	public function getAnonymousAttenders() {
		$criteria = new CDbCriteria();
		$criteria->compare("eventId", $this->eventId );
		$criteria->compare("signedOff", "false");
		$criteria->order = "lastName ASC";
		return SignupMembershipAnonymous::model()->findAll($criteria);
	}

	public function getAttendersFiveYearArrays() {
		$attenders = $this->getAttenders();
		$attendersArrays = array();
		for ($i = 1; $i <= 5; $i++) {
			$year = array();
			foreach ($attenders as $attender) {
				if ($attender->classYear == $i) {
					array_push($year, $attender);
				}
			}
			usort($year, array(__CLASS__, "userListingComparator"));
			array_push($attendersArrays, $year);
		}
		return $attendersArrays;
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
		return!empty($data);
	}

	public function isOpen() {
		return time() > strtotime($this->open) &&
		time() < strtotime($this->close);
	}

	public function hasFreeSpots() {
		return $this->spots > $this->getAttendingCount();
	}

	public function canAttend() {
		return $this->isOpen() &&
		$this->hasFreeSpots() &&
		app()->gatekeeper->hasPostAccess('signup', $this->eventId) &&
		app()->gatekeeper->hasPostAccess('event', $this->eventId) &&
		!user()->isGuest;
	}
	
	public function canUnattend() {
		return $this->signoff === 'true' || $this->signoff === true;
	}

	private static function userListingComparator($user1, $user2) {
		if ($user1->firstName == $user2->firstName) {
			if ($user1->lastName == $user2->lastName)
				return 0;
			else {
				return ($user1->lastName > $user2->lastName) ? 1 : -1;
			}
		} else {
			return ($user1->firstName > $user2->firstName) ? 1 : -1;
		}
	}
		
		public function getAttendingFraction(){
			return 100*($this->attendingCount / $this->spots);
		}
		
		public function getAttendingColorClass(){
			if ($this->AttendingFraction == 100) {
				return "red";
			}elseif ($this->AttendingFraction > 75) {
				return "orange";
			}else {
				return "green";
			}
		}

}
