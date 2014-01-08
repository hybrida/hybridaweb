<?php

/**
 * This is the model class for table "frontpage_banner".
 *
 * The followings are the available columns in table 'frontpage_banner':
 * @property integer $id
 * @property string $timestamp
 * @property string $title
 * @property string $url
 * @property integer $imageId
 */
class FrontpageBanner extends CActiveRecord
{

	public $imageUpload;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'frontpage_banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timestamp, title, imageId', 'required'),
			array('imageId', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('url', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, timestamp, title, url, imageId', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'timestamp' => 'Timestamp',
			'title' => 'Tittel',
			'url' => 'Url',
			'imageId' => 'Bilde',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FrontpageBanner the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function getLatestBanner() {
		$crit = new CDbCriteria();
		$crit->limit = 1;
		$crit->order = "timestamp DESC";
		$model = self::model()->find($crit);
		return $model;
	}

	public static function getBanner() {
		$banner = self::getLatestBanner();
		if ($banner === null) {
			return "";
		}
		$imgTag = Image::tag($banner->imageId, 'frontpage_banner');
		if ($banner->url) {
			return CHtml::link($imgTag, $banner->url);
		}
		return $imgTag;
	}

	public function beforeValidate() {
		if ($this->isNewRecord) {
			$this->timestamp = new CDbExpression("NOW()");
		}
		return true;

	}
}
