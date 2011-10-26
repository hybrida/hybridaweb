<?php

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
class Signup extends CActiveRecord
{
	
	private $_access;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Signup the static model class
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
		return 'signup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spots, open, close', 'required'),
			array('eventId, spots', 'numerical', 'integerOnly'=>true),
			array('signoff', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('eventId, spots, open, close, signoff', 'safe', 'on'=>'search'),
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('eventId',$this->eventId);
		$criteria->compare('spots',$this->spots);
		$criteria->compare('open',$this->open,true);
		$criteria->compare('close',$this->close,true);
		$criteria->compare('signoff',$this->signoff,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
		$this->_access->save();
	}
}