<?php

/**
 * This is the model class for table "fb_user".
 *
 * The followings are the available columns in table 'fb_user':
 * @property integer $userId
 * @property string $fb_token
 * @property string $postEvents
 */
class FacebookUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FacebookUser the static model class
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
		return 'fb_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, fb_token', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('fb_token', 'length', 'max'=>100),
			array('postEvents', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, fb_token, postEvents', 'safe', 'on'=>'search'),
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
			'fb_token' => 'Fb Token',
			'postEvents' => 'Post Events',
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
		$criteria->compare('fb_token',$this->fb_token,true);
		$criteria->compare('postEvents',$this->postEvents,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}