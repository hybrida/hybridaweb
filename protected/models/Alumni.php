<?php

/**
 * This is the model class for table "alumni".
 *
 * The followings are the available columns in table 'alumni':
 * @property integer $id
 * @property integer $event_id
 * @property string $navn
 */
class Alumni extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Alumni the static model class
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
		return 'alumni';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('event_id, navn', 'required'),
				array('event_id', 'numerical', 'integerOnly'=>true),
				array('navn', 'length', 'max'=>60),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, event_id, navn', 'safe', 'on'=>'search'),
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
				'event_id' => 'Event',
				'navn' => 'Navn',
				);
	}

	public static function getAlumniNamesByEventId($eid)
	{
		$alumnis = Alumni::model()->findAll('event_id =' . $eid);	
		$names = array();
		foreach($alumnis as $alumni)
			$names[] = $alumni['navn'];
		return $names;
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('navn',$this->navn,true);

		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					));
	}
}
