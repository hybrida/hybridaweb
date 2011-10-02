<?php

/**
 * This is the model class for table "membership_group".
 *
 * The followings are the available columns in table 'membership_group':
 * @property integer $groupId
 * @property integer $userId
 * @property string $comission
 */
class MembershipGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MembershipGroup the static model class
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
		return 'membership_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comission', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('comission', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('groupId, userId, comission', 'safe', 'on'=>'search'),
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
			'groupId' => 'Group',
			'userId' => 'User',
			'comission' => 'Comission',
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

		$criteria->compare('groupId',$this->groupId);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('comission',$this->comission,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}