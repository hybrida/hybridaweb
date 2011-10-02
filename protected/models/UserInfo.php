<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property integer $userId
 * @property string $firstName
 * @property string $middleName
 * @property string $sirName
 * @property integer $specialization
 * @property string $graduationYear
 * @property string $member
 * @property string $gender
 * @property integer $access
 * @property integer $imageId
 * @property integer $phoneNumber
 * @property string $lastLogin
 * @property string $cardinfo
 * @property string $description
 * @property string $birthdate
 * @property string $altEmail
 */
class UserInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, firstName, sirName, member, imageId, cardinfo, description, birthdate, altEmail', 'required'),
			array('userId, specialization, access, imageId, phoneNumber', 'numerical', 'integerOnly'=>true),
			array('firstName, middleName, sirName', 'length', 'max'=>30),
			array('graduationYear', 'length', 'max'=>4),
			array('member', 'length', 'max'=>5),
			array('gender', 'length', 'max'=>7),
			array('cardinfo', 'length', 'max'=>10),
			array('description', 'length', 'max'=>500),
			array('altEmail', 'length', 'max'=>25),
			array('lastLogin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, firstName, middleName, sirName, specialization, graduationYear, member, gender, access, imageId, phoneNumber, lastLogin, cardinfo, description, birthdate, altEmail', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'User',
			'firstName' => 'First Name',
			'middleName' => 'Middle Name',
			'sirName' => 'Sir Name',
			'specialization' => 'Specialization',
			'graduationYear' => 'Graduation Year',
			'member' => 'Member',
			'gender' => 'Gender',
			'access' => 'Access',
			'imageId' => 'Image',
			'phoneNumber' => 'Phone Number',
			'lastLogin' => 'Last Login',
			'cardinfo' => 'Cardinfo',
			'description' => 'Description',
			'birthdate' => 'Birthdate',
			'altEmail' => 'Alt Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userId',$this->userId);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('middleName',$this->middleName,true);
		$criteria->compare('sirName',$this->sirName,true);
		$criteria->compare('specialization',$this->specialization);
		$criteria->compare('graduationYear',$this->graduationYear,true);
		$criteria->compare('member',$this->member,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('access',$this->access);
		$criteria->compare('imageId',$this->imageId);
		$criteria->compare('phoneNumber',$this->phoneNumber);
		$criteria->compare('lastLogin',$this->lastLogin,true);
		$criteria->compare('cardinfo',$this->cardinfo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('altEmail',$this->altEmail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}