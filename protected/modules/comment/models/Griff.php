<?php

/**
 * This is the model class for table "griff".
 *
 * The followings are the available columns in table 'griff':
 * @property integer $id
 * @property integer $commentId
 * @property integer $userId
 * @property integer $isDeleted
 */
class Griff extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'griff';
	}

	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('commentId, userId', 'required'),
			array('commentId, userId, isDeleted', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, commentId, userId, isDeleted', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'commentId' => 'Comment',
			'userId' => 'User',
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
		$criteria->compare('commentId', $this->commentId);
		$criteria->compare('userId', $this->userId);
		$criteria->compare('isDeleted', $this->isDeleted);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public static function get($commentId, $userId) {
		return Griff::model()->find('commentId = :commentId AND userId = :userId', array(
					'commentId' => $commentId,
					'userId' => $userId,
		));
	}

	public static function add($commentId, $userId) {
		$g = new Griff;
		$g->commentId = $commentId;
		$g->userId = $userId;
		$g->save();
	}

	public static function remove($commentId, $userId) {
		$g = self::get($commentId, $userId);
		$g->isDeleted = 1;
		$g->save();
	}

}