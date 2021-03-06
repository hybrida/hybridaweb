<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $title
 * @property string $oldName
 * @property integer $albumId
 * @property integer $userId
 * @property string $timestamp
 */
class Image extends CActiveRecord {

	public static $sizes = array(
		'profile' => array('width' => 249),
		'small' => array('width' => 75, 'height' => 75),
		'xsmall' => array('width' => 55, 'height' => 55),
		'mini' => array('width' => 40, 'height' => 40),
		'frontpage' => array('width' => 600, 'height' => 150),
		'frontpage_banner' => array('width' => 1000),
		'sidebar' => array('width' => 150),
		'gallery_thumb' => array('width' => 225, 'height' => 225),
		'gallery_big' => array('max_width' => 691),
	);

	/**
	 * Returns the static model of the specified AR class.
	 * @return Image the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oldName', 'required'),
			array('userId', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 255),
			array('oldName', 'length', 'max' => 255),
			array('timestamp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, oldName, albumId, userId, timestamp', 'safe', 'on' => 'search'),
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
			'title' => 'Title',
			'oldName' => 'Old Name',
			'albumId' => 'Album',
			'userId' => 'User',
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
		$criteria->compare('title', $this->title, true);
		$criteria->compare('oldName', $this->oldName, true);
		$criteria->compare('albumId', $this->albumId);
		$criteria->compare('userId', $this->userId);
		$criteria->compare('timestamp', $this->timestamp, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function hasDeleteAccess()
	{
		if (!isset(Yii::app()->user))
			return false;

		if	(Yii::app()->user->id == $this->userId)
			return true;

		if (Yii::app()->gatekeeper->hasGroupAccess(55))
			return true;
	}

	public function getFilePath($size = "original") {
		if ($this->isNewRecord) {
			throw new CException("Filen er ikke lagret i databasen, og har derfor ingen plassering");
		}
		return Yii::getPathOfAlias("webroot") . self::getRelativeFilePath($this->id, $size);
	}

	public static function getResized($id, $size) {
		$image = Image::model()->findByPk($id);
		if ($image == null) {
			throw new FileNotFoundException("The picture '$size/$id' does not exist");
		} else if (!Image::sizeExists($size)) {
			throw new CException("The size '$size' does not exists");
		}
		if (!$image->hasSize($size)) {
			$image->resize($size);
		}
		return $image;
	}

	public static function tag($id, $size, $htmlOptions = array('alt' => '')) {
		list($width, $height) = self::getSize($size);
		if ($width)
			$htmlOptions['width'] = $width;
		if ($height)
			$htmlOptions['height'] = $height;
		try {
			$url = self::getViewUrl($id, $size);
			return CHtml::image($url, "", $htmlOptions);
		} catch (FileNotFoundException $e) {

		}
	}

	public static function getViewUrl($id, $size) {
		$image = self::getResized($id, $size);
		return Yii::app()->baseUrl . self::getRelativeFilePath($id, $size);
	}

	public static function getRelativeFilePath($id, $size) {
		$filename = self::getFileName($id);
		$filePath = "/upc/images/$size/$filename.jpg";
		return $filePath;
	}

	public static function profileTag($id, $size) {
		if ($id != null) {
			return self::tag($id, $size);
		}
		$url = "";
		switch ($size) {
			case "xsmall":
				$url = "unknown_profile_xsmall";
				break;
			case "small":
				$url = "unknown_profile_small";
				break;
			case "mini":
				$url = "unknown_profile_mini";
				break;
			case "profile":
				$url = "unknown_profile";
				break;
		}
		$htmlOptions = self::$sizes[$size];
		return CHtml::image("/images/$url.jpg", "Profile picture", $htmlOptions);
	}

	public static function getImageDir() {
		return Yii::getPathOfAlias("webroot.upc.images");
	}

	public static function getFileName($id) {
		return sha1("hybrida" . $id);
	}

	public function hasSize($size) {
		$filename = $this->getFilePath($size);
		return file_exists($filename);
	}

	public static function sizeExists($size) {
		return array_key_exists($size, self::$sizes);
	}

	public function resize($size) {
		if (!self::sizeExists($size))
			return;
		$this->throwExceptionIfFileDoesNotExist();
		$si = new SimpleImage($this->getFilePath());
		list($width, $height, $max_width, $max_height) = self::getSize($size);
		if ($height && $width) {
			$si->crop($width, $height);
		} else if ($height) {
			$si->resizeToHeight($height);
		} else if ($width) {
			$si->resizeToWidth($width);
		}
		if ($max_height && $si->getHeight() > $max_height) {
			$si->resizeToHeight($max_height);
		}
		if ($max_width && $si->getWidth() > $max_width) {
			$si->resizeToWidth($max_width);
		}
		$si->save($this->getFilePath($size));
	}

	private function throwExceptionIfFileDoesNotExist() {
		if (!file_exists($this->getFilePath())) {
			throw new FileNotFoundException("The image " . $this->id . " Does not exist");
		}
	}

	public static function getSize($size) {
		if (!self::sizeExists($size)) {
			throw new CException("Size '$size' does not exist");
		}
		$ar = self::$sizes[$size];
		$width = isset($ar['width']) ? $ar['width'] : null;
		$height = isset($ar['height']) ? $ar['height'] : null;
		$max_width = isset($ar['max_width']) ? $ar['max_width'] : null;
		$max_height = isset($ar['max_height']) ? $ar['max_height'] : null;
		return array($width, $height, $max_width, $max_height);
	}

	public static function uploadByModel($model, $attribute, $userId) {
		$uploadedFile = CUploadedFile::getInstance($model, $attribute);
		$image = self::uploadAndSave($uploadedFile, $userId);
		return $image;
	}

	public static function uploadAndSave($uploadedFile, $userId, $useRename = false) {
		$image = new Image();
		$image->oldName = $uploadedFile;
		if (!$image->oldName) {
			throw new NoFileIsUploadedException();
		}
		$image->save();
		$dirname = dirname($image->getFilePath());
		SimpleImage::createDirectoryIfNotExists($dirname);
		if (!$useRename) {
			$image->oldName->saveAs($image->getFilePath());
		} else {
			$ren = rename($image->oldName->tempName, $image->getFilePath());
		}
		$image->title = $image->oldName;
		$image->timestamp = new CDbExpression("NOW()");
		$image->userId = $userId;
		$image->save();
		return $image;
	}

}

/*
 * File: SimpleImage.php
 * Author: Simon Jarvis
 * Copyright: 2006 Simon Jarvis
 * Date: 08/11/06
 * Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/gpl.html
 *
 */

class SimpleImage {

	private $image;
	private $image_type;

	public function __construct($filename) {

		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if ($this->image_type == IMAGETYPE_JPEG) {

			$this->image = imagecreatefromjpeg($filename);
		} elseif ($this->image_type == IMAGETYPE_GIF) {

			$this->image = imagecreatefromgif($filename);
		} elseif ($this->image_type == IMAGETYPE_PNG) {

			$this->image = imagecreatefrompng($filename);
		}
	}

	public static function createDirectoryIfNotExists($directory) {
		if (!is_dir($directory)) {
			mkdir($directory);
			chmod($directory, 0770);
		}
	}

	public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
		self::createDirectoryIfNotExists(dirname($filename));

		if ($image_type == IMAGETYPE_JPEG) {
			imagejpeg($this->image, $filename, $compression);
		} elseif ($image_type == IMAGETYPE_GIF) {

			imagegif($this->image, $filename);
		} elseif ($image_type == IMAGETYPE_PNG) {

			imagepng($this->image, $filename);
		}
		if ($permissions != null) {

			chmod($filename, $permissions);
		}
	}

	function output($image_type = IMAGETYPE_JPEG) {

		if ($image_type == IMAGETYPE_JPEG) {
			imagejpeg($this->image);
		} elseif ($image_type == IMAGETYPE_GIF) {

			imagegif($this->image);
		} elseif ($image_type == IMAGETYPE_PNG) {

			imagepng($this->image);
		}
	}

	function getWidth() {

		return imagesx($this->image);
	}

	function getHeight() {

		return imagesy($this->image);
	}

	function resizeToHeight($height) {

		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width, $height);
	}

	function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width, $height);
	}

	function scale($scale) {
		$width = $this->getWidth() * $scale / 100;
		$height = $this->getheight() * $scale / 100;
		$this->resize($width, $height);
	}

	function resize($width, $height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}

	public function crop($crop_width, $crop_height) {
		$cropped_image_gd = imagecreatetruecolor($crop_width, $crop_height);
		$original_image_gd = $this->image;
		$original_width = $this->getWidth();
		$original_height = $this->getHeight();
		$widthRatio = $original_width / $crop_width;
		$heightRatio = $original_height / $crop_height;
		$originalRation = $original_width / $original_height;
		$cropRatio = $crop_width / $crop_height;
		$h_height = $crop_height / 2;
		$w_height = $crop_width / 2;

		$cropWidthFirst = $originalRation > $cropRatio;
		if ($cropWidthFirst) {
			$adjusted_width = $original_width / $heightRatio;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;

			imagecopyresampled($cropped_image_gd, $original_image_gd, -$int_width, 0, 0, 0, $adjusted_width, $crop_height, $original_width, $original_height);
		} else {
			$adjusted_height = $original_height / $widthRatio;
			$half_height = $adjusted_height / 2;
			$int_height = $half_height - $h_height;

			imagecopyresampled($cropped_image_gd, $original_image_gd, 0, -$int_height, 0, 0, $crop_width, $adjusted_height, $original_width, $original_height);
		}
		$this->image = $cropped_image_gd;
	}

}

