<?php

/**
 * This is the model class for table "job".
 *
 * The followings are the available columns in table 'job':
 * @property integer $id
 * @property integer $companyId
 * @property string $start
 * @property string $end
 * @property string $title
 * @property string $description
 *
 * The followings are the available model relations:
 * @property BkCompany $company
 */
class JobAnnouncement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Job the static model class
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
		return 'job_announcement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyId, start, end, title, description', 'required'),
			array('companyId', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, companyId, start, end, title, description', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'companyId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'companyId' => 'Company',
			'start' => 'Start',
			'end' => 'End',
			'title' => 'Title',
			'description' => 'Description',
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
		$criteria->compare('companyId',$this->companyId);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getViewUrl() {
		return Yii::app()->createUrl("/jobAnnouncement/view", array(
					"id" => $this->id,
					'name' => $this->title,
				));
	}
}