<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property integer $parentId
 * @property string $parentType
 * @property string $content
 * @property integer $authorId
 * @property string $timestamp
 * @property string $isDeleted
 */
class Comment extends CActiveRecord {

	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parentId, authorId', 'numerical', 'integerOnly' => true),
			array('parentType', 'length', 'max' => 7),
			array('isDeleted', 'length', 'max' => 5),
			array('content, timestamp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parentId, parentType, content, authorId, timestamp, isDeleted', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			'content' => 'Content',
			'authorId' => 'Author',
			'timestamp' => 'Timestamp',
			'isDeleted' => 'Is Deleted',
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
		$criteria->compare('content', $this->content, true);
		$criteria->compare('authorId', $this->authorId);
		$criteria->compare('timestamp', $this->timestamp, true);
		$criteria->compare('isDeleted', $this->isDeleted, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	protected function beforeSave() {
		if ($this->isNewRecord) {
			$this->timestamp = new CDbExpression("NOW()");
			$this->authorId = user()->id;
		}
		return parent::beforeSave();
	}

	public function hasDeleteAccess() {
		return Yii::app()->user->checkAccess("deleteComment", array('authorId' => $this->authorId));
	}

	public function delete() {
		$this->isDeleted = "true";
		$this->save();
	}

	public static function getAll($type, $id) {
		return Comment::model()->findAll("parentId = :id AND parentType = :type AND isDeleted = 'false' ORDER BY `timestamp` ASC", array(
					":id" => $id,
					":type" => $type));
	}

}