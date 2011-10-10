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
 * @property integer $author
 * @property string $timestamp
 */
class News extends CActiveRecord {

	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__) {
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
				array('parentId, imageId, author', 'numerical', 'integerOnly' => true),
				array('parentType', 'length', 'max' => 7),
				array('title', 'length', 'max' => 50),
				array('content, timestamp', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parentId, parentType, title, imageId, content, author, timestamp', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
				'author' => 'Author',
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
		$criteria->compare('content', $this->content, true);
		$criteria->compare('author', $this->author);
		$criteria->compare('timestamp', $this->timestamp, true);

		return new CActiveDataProvider($this, array(
								'criteria' => $criteria,
						));
	}

	public function getEventId() {
		
		if (!$this->parentIsEvent())
			return false;

		$sql = "SELECT * FROM event WHERE id = :id";
		$stmt = Yii::app()->db->getPdoInstance->prepare($sql);
		$stmt->bindValue("id", $this->parentId);
		$stmt->execute(PDO::FETCH_ASSOC);
		$eventInfo = $stmt->fetch();

		if ($eventInfo) {
			return $eventInfo['id'];
		}
		return false;
	}

	function getEvent() {
		if (!$this->parentIsEvent())
			return null;

		$sql = "SELECT * FROM event WHERE id = :id";
		$stmt = Yii::app()->db->getPdoInstance->prepare($sql);
		$stmt->bindValue("id", $this->parentId);
		$stmt->execute(PDO::FETCH_ASSOC);
		$eventInfo = $stmt->fetch();
		
		return $eventInfo ? $eventInfo : null;
	}
	
	private function parentIsEvent() {
		return !$this->getIsNewRecord() && !$this->parentType == "event";
	}
	
	public function setEventById($id) {
		
	}

}