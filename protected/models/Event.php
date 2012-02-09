<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property integer $bpcID
 * @property string $start
 * @property string $end
 * @property string $location
 * @property integer $access
 * @property string $title
 * @property integer $imageId
 * @property string $content
 */
class Event extends CActiveRecord {
	
	private $_access;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Event the static model class
	 */
	private $signupModel = null;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('imageId', 'numerical', 'integerOnly' => true),
		  array('location, title', 'length', 'max' => 30),
		  array('start, end', 'safe'),
		  // The following rule is used by search().
		  // Please remove those attributes that should not be searched.
		  array('id, start, end, location, title, imageId', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'signup' => array(self::BELONGS_TO, 'Signup', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
		  'id' => 'ID',
		  'start' => 'Start',
		  'end' => 'End',
		  'location' => 'Location',
		  'title' => 'Title',
		  'imageId' => 'Image',
		  'content' => 'Content',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('start', $this->start, true);
		$criteria->compare('end', $this->end, true);
		$criteria->compare('location', $this->location, true);
		$criteria->compare('access', $this->access);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('imageId', $this->imageId);
		$criteria->compare('content', $this->content, true);

		return new CActiveDataProvider($this, array(
				  'criteria' => $criteria,
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
		$this->_access->replace();
	}

	public function getSignup() {
		$this->setSignupIfIsNull();
		return $this->signupModel;
	}

	public function hasSignup() {
		$this->setSignupIfIsNull();
		return $this->signupModel != null;
	}

	private function setSignupIfIsNull() {
		if ($this->signupModel == null)
			$this->setSignup();
	}

	private function setSignup() {
		$this->signupModel = Signup::model()->findByPk($this->id);
	}

}