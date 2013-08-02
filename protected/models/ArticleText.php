<?php

/**
 * This is the model class for table "article_text".
 *
 * The followings are the available columns in table 'article_text':
 * @property integer $id
 * @property integer $articleId
 * @property string $content
 * @property string $timestamp
 */
class ArticleText extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ArticleText the static model class
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
		return 'article_text';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('articleId, timestamp', 'required'),
			array('articleId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, articleId, content, timestamp', 'safe', 'on'=>'search'),
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
			'article' => array(self::BELONGS_TO, 'article', 'article	'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'articleId' => 'Article',
			'content' => 'Tekst',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('articleId',$this->articleId);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeValidate() {
		$this->timestamp = new CDbExpression('NOW()');
		return parent::beforeValidate();
	}

	public function purify() {
		$purifier = new CHtmlPurifier();
		$this->content = $purifier->purify($this->content);
	}
}
