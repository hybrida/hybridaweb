<?php

/**
 * This is the model class for table "bk_company".
 *
 * The followings are the available columns in table 'bk_company':
 * @property integer $companyID
 * @property string $adress
 * @property integer $contactorID
 * @property string $companyName
 * @property string $dateAdded
 * @property string $dateUpdated
 * @property string $dateAssigned
 * @property string $homepage
 * @property integer $addedByID
 * @property string $mail
 * @property integer $updatedByID
 * @property string $postbox
 * @property integer $postnumber
 * @property string $postplace
 * @property string $status
 * @property integer $phoneNumber
 * @property integer $subgroupOfID
 *
 * The followings are the available model relations:
 * @property Job[] $jobs
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Company the static model class
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
		return 'bk_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contactorID, addedByID, updatedByID, postnumber, phoneNumber, subgroupOfID', 'numerical', 'integerOnly'=>true),
			array('adress, companyName, homepage, mail, postbox, postplace', 'length', 'max'=>255),
			array('status', 'length', 'max'=>14),
			array('dateAdded, dateUpdated, dateAssigned', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('companyID, adress, contactorID, companyName, dateAdded, dateUpdated, dateAssigned, homepage, addedByID, mail, updatedByID, postbox, postnumber, postplace, status, phoneNumber, subgroupOfID', 'safe', 'on'=>'search'),
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
			'jobs' => array(self::HAS_MANY, 'Job', 'companyID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'companyID' => 'Company',
			'adress' => 'Adress',
			'contactorID' => 'Contactor',
			'companyName' => 'Company Name',
			'dateAdded' => 'Date Added',
			'dateUpdated' => 'Date Updated',
			'dateAssigned' => 'Date Assigned',
			'homepage' => 'Homepage',
			'addedByID' => 'Added By',
			'mail' => 'Mail',
			'updatedByID' => 'Updated By',
			'postbox' => 'Postbox',
			'postnumber' => 'Postnumber',
			'postplace' => 'Postplace',
			'status' => 'Status',
			'phoneNumber' => 'Phone Number',
			'subgroupOfID' => 'Subgroup Of',
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

		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('contactorID',$this->contactorID);
		$criteria->compare('companyName',$this->companyName,true);
		$criteria->compare('dateAdded',$this->dateAdded,true);
		$criteria->compare('dateUpdated',$this->dateUpdated,true);
		$criteria->compare('dateAssigned',$this->dateAssigned,true);
		$criteria->compare('homepage',$this->homepage,true);
		$criteria->compare('addedByID',$this->addedByID);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('updatedByID',$this->updatedByID);
		$criteria->compare('postbox',$this->postbox,true);
		$criteria->compare('postnumber',$this->postnumber);
		$criteria->compare('postplace',$this->postplace,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('phoneNumber',$this->phoneNumber);
		$criteria->compare('subgroupOfID',$this->subgroupOfID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getId() {
		return $this->companyID;
	}
	
	public function setId($id) {
		$this->companyID = $id;
	}
	
	public function getName() {
		return $this->companyName;
	}
	
	public function setName($name) {
		$this->companyName = $name;
	}
}