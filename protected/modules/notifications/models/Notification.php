<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id
 * @property string $parentType
 * @property integer $parentID
 * @property integer $userID
 * @property integer $isRead
 * @property string $timestamp
 * @property integer $changedByUserID
 * @property integer $statusCode
 */
class Notification extends CActiveRecord
{
	
	private $_model = false;
	
	private static $MODEL_IS_NOT_SET = false;
	
	const STATUS_CHANGED = 0;
	const STATUS_NEW_COMMENT = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Notification the static model class
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
		return 'notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parentType, parentID, userID', 'required'),
			array('parentID, userID, isRead, changedByUserID, statusCode', 'numerical', 'integerOnly'=>true),
			array('parentType', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parentType, parentID, userID, isRead, timestamp, changedByUserID, commentID, statusCode', 'safe', 'on'=>'search'),
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
			'changedByUser' => array(self::BELONGS_TO, 'User', 'changedByUserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parentType' => 'Parent Type',
			'parentID' => 'Parent',
			'userID' => 'User',
			'isRead' => 'Is Read',
			'timestamp' => 'Timestamp',
			'changedByUserID' => 'Changed By User',
			'statusCode' => 'Status Code',
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
		$criteria->compare('parentType',$this->parentType,true);
		$criteria->compare('parentID',$this->parentID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('isRead',$this->isRead);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('statusCode',$this->statusCode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	private function initModel() {
		$model = null;
		switch ($this->parentType) {
			case 'profile':
				$model = User::model()->findByPk($this->parentID);
				break;
			case 'news':
				$model = News::model()->findByPk($this->parentID);
				break;
		}
		$this->_model = $model;
	}
	
	public function getViewUrl() {
		$url = "";
		if ($this->_model) {
			if ($this->_model->tableName() == 'user') {
				$url = Yii::app()->createUrl("/profile/comment", array('username' => $this->_model->username));
			} else {
				$url =  $this->_model->viewUrl;
			}
		} else if ($this->_model === self::$MODEL_IS_NOT_SET){
			$this->initModel();
			return $this->getViewUrl();
		} else {
			$url = '#';
		}
		
		if ($this->commentID !== null) {
			$url .= "#comment-" . $this->commentID;
		}
		return $url;
	}
	
	public function getMessage() {
		
		return Notifications::getMessage($this->statusCode);
	}
	
	public function getTitle() {
		if ($this->_model) {
			switch ($this->parentType) {
				case 'news':
					return $this->_model->title;
					break;
				case 'profile':
					return 'profilen til ' . $this->_model->fullname;
			}
		} else if ($this->_model === self::$MODEL_IS_NOT_SET) {
			$this->initModel();
			return $this->getTitle();
		}
	}
	
}