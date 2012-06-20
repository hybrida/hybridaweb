<?php

/**
 * This is the model class for table "book_sales".
 *
 * The followings are the available columns in table 'book_sales':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $price
 * @property integer $author
 * @property integer $imageID
 * @property string $timestamp
 */
class BookSale extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BookSale the static model class
	 */
	const SOLD = 0;
	const FOR_SALE = 1;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book_sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, price, author', 'required'),
			array('price, author, imageID', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>30),
                        array('price', 'numerical', 'min'=>1, 'max'=>999999),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, status, content, price, author, imageID, timestamp', 'safe', 'on'=>'search'),
			array('status', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
            	return array(
			'author' => array(self::BELONGS_TO, 'user', 'author'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'price' => 'Price',
			'author' => 'Author',
			'imageID' => 'Image',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('author',$this->author);
		$criteria->compare('imageID',$this->imageID);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}