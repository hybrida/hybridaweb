<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $parentId
 * @property string $parentType
 * @property string $title
 * @property integer $imageId
 * @property string $content
 * @property integer $authorId
 * @property string $timestamp
 * @property array $access
 */
class News extends CActiveRecord {

	private $_access;

	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parentId, imageId, authorId', 'numerical', 'integerOnly' => true),
			array('parentType', 'length', 'max' => 7),
			array('title', 'length', 'max' => 50),
			array('title, imageId, ingress, content, timestamp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parentId, parentType, title, imageId, authorId, timestamp', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
			'event' => array(self::BELONGS_TO, 'Event', 'parentId'),
			'image' => array(self::BELONGS_TO, 'Image', 'imageId'),
			'author' => array(self::BELONGS_TO, 'User', 'authorId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'parentId' => 'Parent',
			'parentType' => 'Parent Type',
			'title' => 'Title',
			'imageId' => 'Image',
			'content' => 'Content',
			'ingress' => 'Ingress',
			'authorId' => 'Author',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('parentId', $this->parentId);
		$criteria->compare('parentType', $this->parentType, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('imageId', $this->imageId);
		$criteria->compare('authorId', $this->authorId);
		$criteria->compare('timestamp', $this->timestamp, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function afterConstruct() {
		$this->_access = new AccessRelation($this);
		return parent::afterConstruct();
	}

	public function afterFind() {
		$this->afterConstruct();
		return parent::afterFind();
	}

	public function setAccess($array) {
		$this->_access->set($array);
	}

	public function getAccess() {
		return $this->_access->get();
	}

	public function afterSave() {
		$this->_access->replace();
		return parent::afterSave();
	}
	
	public function purify() {
		$purifier = new CHtmlPurifier();
		$this->ingress = $purifier->purify($this->ingress);
		$this->content = $purifier->purify($this->content);
		$this->title = $purifier->purify($this->title);
		return parent::beforeValidate();
	}

	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->authorId = Yii::app()->user->id;
			$this->timestamp = new CDbExpression('NOW()');
		}
		return parent::beforeSave();
	}

	public function setParent($type, $id) {
		$this->parentType = $type;
		$this->parentId = $id;
	}

	public function getParentType() {
		return $this->parentType;
	}

	public function getParentId() {
		return $this->parentId;
	}

	public function getAuthorName() {
		$authorId = User::model()->findByPk($this->authorId);
		$name = "";
		if ($authorId) {
			$name = $authorId->firstName . " " . $authorId->middleName . " " . $authorId->lastName;
		}
		return $name;
	}

	public function getViewUrl() {
		return Yii::app()->createUrl("news/view", array(
					"id" => $this->id,
					'title' => $this->getTitleWithDelimiters(),
				));
	}

	private function getTitleWithDelimiters() {
		return str_replace(' ', '-', $this->title);
	}

}