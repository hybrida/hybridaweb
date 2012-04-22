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
		  array('location', 'length', 'max' => 30),
		  array('start, end', 'safe'),
		  // The following rule is used by search().
		  // Please remove those attributes that should not be searched.
		  array('id, start, end, location', 'safe', 'on' => 'search'),
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
	
	public function getGoogleCalendarButton() {
		$news = News::model()->find('parentType = "event" AND parentId = ?',array(
			$this->id,
		));
		if (!$news) {
			return null;
		}
		$from = $this->getUTC($this->start);
		$to = $this->getUTC($this->end);

		return "<a href=\"http://www.google.com/calendar/event?action=TEMPLATE".
			"&text={$this->spaceToUrl($news->title)}".
			"&dates={$from}/{$to}".
			"&details={$this->spaceToUrl($news->ingress)}".
			"&location={$this->spaceToUrl($this->location)}".
			"&trp=true".
			"&sprop=http%3A%2F%2Fhybrida.no".
			"&sprop=name:Hybrida\" target=\"_blank\">Legg til i kalender</a>";
	}
	
	private function spaceToUrl($text) {
		return str_replace(" ", "%20", $text);
	}
	
	private function getUTC($timeString) {
		return gmdate("Ymd\THis\Z",strtotime($timeString));
	}

}