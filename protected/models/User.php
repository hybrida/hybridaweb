<?php

/**
 * This is the model class for table "user_new".
 *
 * The followings are the available columns in table 'user_new':
 * @property integer $id
 * @property string $username
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property integer $specialization
 * @property string $graduationYear
 * @property string $member
 * @property string $gender
 * @property integer $imageId
 * @property integer $phoneNumber
 * @property string $lastLogin
 * @property string $cardinfo
 * @property string $description
 * @property string $birthdate
 * @property string $altEmail
 */
class User extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user_new';
	}

	public function rules() {
		return array(
			array('username, firstName, lastName, member', 'required'),
			array('specialization, imageId, phoneNumber', 'numerical', 'integerOnly' => true),
			array('username, cardinfo', 'length', 'max' => 10),
			array('firstName, middleName, lastName', 'length', 'max' => 75),
			array('graduationYear', 'length', 'max' => 4),
			array('member', 'length', 'max' => 5),
			array('gender', 'length', 'max' => 7),
			array('altEmail', 'length', 'max' => 255),
			array('lastLogin, description, birthdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, firstName, middleName, lastName, specialization, graduationYear, member, gender, imageId, phoneNumber, lastLogin, cardinfo, description, birthdate, altEmail', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'firstName' => 'First Name',
			'middleName' => 'Middle Name',
			'lastName' => 'Last Name',
			'specialization' => 'Specialization',
			'graduationYear' => 'Graduation Year',
			'member' => 'Member',
			'gender' => 'Gender',
			'imageId' => 'Image',
			'phoneNumber' => 'Phone Number',
			'lastLogin' => 'Last Login',
			'cardinfo' => 'Cardinfo',
			'description' => 'Description',
			'birthdate' => 'Birthdate',
			'altEmail' => 'Alt Email',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('firstName', $this->firstName, true);
		$criteria->compare('middleName', $this->middleName, true);
		$criteria->compare('lastName', $this->lastName, true);
		$criteria->compare('specialization', $this->specialization);
		$criteria->compare('graduationYear', $this->graduationYear, true);
		$criteria->compare('member', $this->member, true);
		$criteria->compare('gender', $this->gender, true);
		$criteria->compare('imageId', $this->imageId);
		$criteria->compare('phoneNumber', $this->phoneNumber);
		$criteria->compare('lastLogin', $this->lastLogin, true);
		$criteria->compare('cardinfo', $this->cardinfo, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('birthdate', $this->birthdate, true);
		$criteria->compare('altEmail', $this->altEmail, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function getAccess() {
		$gender = $this->getGenderAccess();
		$groups = $this->getGroupsAccess();
		$year = $this->getYearAccess();
		$specialization = $this->getSpecializationAccess();
		$general = $this->getGeneralAccess();
		return array_merge($general, $gender, $year, $specialization, $groups);
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
		$groups = MembershipGroup::model()->findAll("userId = :id", array(
			'id' => $this->id,
				));
		$access = array();
		foreach ($groups as $group) {
			$access[] = Access::GROUP_START + $group->groupId;
		}
		return $access;
	}

	private function getYearAccess() {
		return array((int)$this->graduationYear);
	}

	private function getSpecializationAccess() {
		if ($this->specialization) {
			return array(Access::SPECIALIZATION_START + $this->specialization);
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

}