<?php

/**
 * This is the model class for table "notification_listener".
 *
 * The followings are the available columns in table 'notification_listener':
 * @property integer $id
 * @property integer $userID
 * @property string $parentType
 * @property integer $parentID
 */
class NotificationListener extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationListener the static model class
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
		return 'notification_listener';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, parentType, parentID', 'required'),
			array('userID, parentID', 'numerical', 'integerOnly'=>true),
			array('parentType', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, parentType, parentID', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'userID' => 'User',
			'parentType' => 'Parent Type',
			'parentID' => 'Parent',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('parentType',$this->parentType,true);
		$criteria->compare('parentID',$this->parentID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}