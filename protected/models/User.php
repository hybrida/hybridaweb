<?php

/**
 * This is the model class for table "hyb_user".
 *
 * The followings are the available columns in table 'hyb_user':
 * @property integer $id
 * @property string $username
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property integer $specializationId
 * @property string $graduationYear
 * @property string $member
 * @property string $gender
 * @property integer $imageId
 * @property integer $phoneNumber
 * @property string $lastLogin
 * @property string $cardinfo
 * @property string $description
 * @property string $workDescription
 * @property integer $workCompanyID
 * @property string $workPlace
 * @property string $birthdate
 * @property string $altEmail
 * @property-read string fullName
 * @property Access $access
 */
class User extends CActiveRecord {

	/**
	 * Returns the static model of the specified AR class.
	 * @return HybUser the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'hyb_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, firstName, lastName, member', 'required'),
			array('specializationId, imageId, phoneNumber, workCompanyID, cardinfo', 'numerical', 'integerOnly' => true),
			array('username, cardinfo', 'length', 'max' => 10),
			array('firstName, middleName, lastName', 'length', 'max' => 75),
			array('graduationYear', 'length', 'max' => 4),
			array('member', 'length', 'max' => 5),
			array('gender', 'length', 'max' => 7),
			array('workPlace, altEmail', 'length', 'max' => 255),
			array('workDescription, lastLogin, description, birthdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, firstName, middleName, lastName, specializationId, graduationYear, member, gender, imageId, phoneNumber, lastLogin, cardinfo, description, workDescription, workCompanyID, workPlace, birthdate, altEmail', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'specialization' => array(self::BELONGS_TO, 'Specialization', 'specializationId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'firstName' => 'First Name',
			'middleName' => 'Middle Name',
			'lastName' => 'Last Name',
			'specializationId' => 'Specialization',
			'graduationYear' => 'Graduation Year',
			'member' => 'Member',
			'gender' => 'Gender',
			'imageId' => 'Image',
			'phoneNumber' => 'Phone Number',
			'lastLogin' => 'Last Login',
			'cardinfo' => 'Cardinfo',
			'description' => 'Description',
			'workDescription' => 'Work Description',
			'workCompanyID' => 'Work Company',
			'workPlace' => 'Work Place',
			'birthdate' => 'Birthdate',
			'altEmail' => 'Alt Email',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('firstName', $this->firstName, true);
		$criteria->compare('middleName', $this->middleName, true);
		$criteria->compare('lastName', $this->lastName, true);
		$criteria->compare('specializationId', $this->specializationId);
		$criteria->compare('graduationYear', $this->graduationYear, true);
		$criteria->compare('member', $this->member, true);
		$criteria->compare('gender', $this->gender, true);
		$criteria->compare('imageId', $this->imageId);
		$criteria->compare('phoneNumber', $this->phoneNumber);
		$criteria->compare('lastLogin', $this->lastLogin, true);
		$criteria->compare('cardinfo', $this->cardinfo, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('workDescription', $this->workDescription, true);
		$criteria->compare('workCompanyID', $this->workCompanyID);
		$criteria->compare('workPlace', $this->workPlace, true);
		$criteria->compare('birthdate', $this->birthdate, true);
		$criteria->compare('altEmail', $this->altEmail, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}
	
	public function purify() {
		$p = new CHtmlPurifier;
		$this->altEmail = $p->purify($this->altEmail);
		$this->description = $p->purify($this->description);
		$this->firstName = $p->purify($this->firstName);
		$this->middleName = $p->purify($this->middleName);
		$this->lastName = $p->purify($this->lastName);
		$this->workDescription = $p->purify($this->workDescription);
		$this->workPlace = $p->purify($this->workPlace);
		parent::afterValidate();
	}

	public function getAccess() {
		$gender = $this->getGenderAccess();
		$groups = $this->getGroupsAccess();
		$year = $this->getYearAccess();
		$specializationId = $this->getSpecializationAccess();
		$general = $this->getGeneralAccess();
		return array_merge($general, $gender, $year, $specializationId, $groups);
	}

	private function getGenderAccess() {
		if ($this->gender == "male") {
			return array(Access::MALE);
		} elseif ($this->gender == "female") {
			return array(Access::FEMALE);
		} else {
			return array();
		}
	}

	private function getGroupsAccess() {
		$groups = GroupMembership::model()->findAll("userId = :id", array(
			'id' => $this->id,
				));
		$access = array();
		foreach ($groups as $group) {
			$access[] = Access::GROUP_START + $group->groupId;
		}
		return $access;
	}

	private function getYearAccess() {
		return array((int) $this->graduationYear);
	}

	private function getSpecializationAccess() {
		if ($this->specializationId) {
			return array(Access::SPECIALIZATION_START + $this->specializationId);
		}
		return array();
	}

	private function getGeneralAccess() {
		$access = array(Access::REGISTERED);
		if ($this->member == "true") {
			$access[] = Access::MEMBER;
		}
		return $access;
	}

	public function getFullName() {
		return $this->firstName . " " . $this->middleName . " " . $this->lastName;
	}
	
	public function getViewUrl() {
		return Yii::app()->createUrl('/profile/info', array(
			'username' => $this->username,
		));
	}
	
	public function getClassYear() {
		return YearConverter::graduationYearToClassYear($this->graduationYear);
	}

}