<?php

/**
 * This is the model class for table "event_company".
 *
 * The followings are the available columns in table 'event_company':
 * @property integer $eventID
 * @property integer $companyID
 * @property integer $bpcID
 */
class EventCompany extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EventCompany the static model class
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
		return 'event_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eventID, bpcID', 'required'),
			array('eventID, companyID, bpcID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('eventID, companyID, bpcID', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'Event', 'eventID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'eventID' => 'Event',
			'companyID' => 'Company',
			'bpcID' => 'Bpc',
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

		$criteria->compare('eventID',$this->eventID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('bpcID',$this->bpcID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}