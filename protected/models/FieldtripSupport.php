<?php

/**
 * This is the model class for table "fieldtrip_support".
 *
 * The followings are the available columns in table 'fieldtrip_support':
 * @property integer $id
 * @property integer $bpcId
 * @property integer $userId
 *
 * The followings are the available model relations:
 * @property User $user
 * @property EventCompany $bpc
 */
class FieldtripSupport extends CActiveRecord
{

	const FIELDTRIP_START_YEAR = 2012;
	/**
	 * Returns the static model of the specified AR class.
	 * @return FieldtripSupport the static model class
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
		return 'fieldtrip_support';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bpcId, userId', 'required'),
			array('bpcId, userId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bpcId, userId', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'bpc' => array(self::BELONGS_TO, 'EventCompany', 'bpcId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bpcId' => 'Bpc',
			'userId' => 'User',
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
		$criteria->compare('bpcId',$this->bpcId);
		$criteria->compare('userId',$this->userId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function canSupport($classYear) {
		if ($classYear == 3) {
			return ! YearConverter::isAutumn() || self::isFieldTripThisYear();
		} elseif($classYear == 4) {
			return self::isFieldTripThisYear();
		}
	}

	public static function isFieldtripOnYear($year) {
		return ($year - self::FIELDTRIP_START_YEAR) % 2 == 0;
	}

	public static function isFieldTripThisYear() {
		return self::isFieldtripOnYear(date('Y'));
	}

	public static function support($userId, $bpcId) {;
		$ft = new FieldtripSupport();
		$ft->userId = $userId;
		$ft->bpcId = $bpcId;
		$ft->save();
	}
}