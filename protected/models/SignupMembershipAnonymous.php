<?php

/**
 * This is the model class for table "signup_membership_anonym".
 *
 * The followings are the available columns in table 'signup_membership_anonym':
 * @property integer $eventId
 * @property string $name
 * @property string $email
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Event $event
 */
class SignupMembershipAnonymous extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SignupMembershipAnonym the static model class
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
		return 'signup_membership_anonymous';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timestamp', 'required'),
			array('eventId', 'numerical', 'integerOnly'=>true),
			array('firstName, lastName, email', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('eventId, firstName, lastName, email, timestamp', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'Event', 'eventId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'eventId' => 'Event',
			'firstName' => 'Fornavn',
			'lastName' => 'Etternavnt',
			'email' => 'Epost',
			'timestamp' => 'Timestamp',
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

		$criteria->compare('eventId',$this->eventId);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterConstruct() {
		$this->timestamp = new CDbExpression("NOW()");
		return parent::afterConstruct();
	}
}
