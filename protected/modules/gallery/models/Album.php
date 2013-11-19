<?php

// Test
/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $id
 * @property integer $user_id
 * @property integer $image_id
 * @property string $title
 * @property string $timestamp
 */
class Album extends CActiveRecord
{
	public $images;
	private $statusDisabled = Status::DELETED;
	private $statusPublished = Status::PUBLISHED;
	private $_access;

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
	public function setAttributes($atts, $safeOnly = true)
	{
		if (array_key_exists('access', $atts))
		{
			$this->setAccess($atts['access']);
			unset($atts['access']);
		}
		return parent::setAttributes($atts, $safeOnly);
	}

	public static function getAlbums()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>Status::PUBLISHED);
		$criteria->order = 'id DESC';
		$allAlbums = Album::model()->findAll($criteria);
		$albums = array();
		foreach($allAlbums as $album)
			if ($album->hasViewAccess())
				$albums[] = $album;
		foreach($albums as $album)
			$album->getImages();
		return $albums;
	}

	public function getImages()
	{
		$id = $this->id;
		$this->images = array();
		$connection = Yii::app()->db;
		$sql = "SELECT image_id
				FROM album_image
				WHERE album_id = :album_id
				AND status = :status";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":album_id", $id);
		$command = $command->bindParam(":status", $this->statusPublished);
		$data = $command->queryColumn();
		foreach ($data as $imageID)
			$this->images[] = Image::model()->findByPk($imageID);
	}

	public function hasViewAccess()
	{
		return Yii::app()->gatekeeper->hasPostAccess('album', $this->id);
	}
	public function hasDeleteAccess()
	{
		if (user()->isGuest)
			return false;

		if	(Yii::app()->user->id == $this->user_id)
			return true;

		if (Yii::app()->gatekeeper->hasGroupAccess(55))
			return true;

		return false;
	}

	 public function addAlbumImageRelation($pid)
	 {
		$id = $this->id;
		$connection = Yii::app()->db;
		$sql = "INSERT INTO album_image (album_id,  image_id) VALUES (:album_id, :image_id)";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":album_id", $id);
		$command = $command->bindParam(":image_id", $pid);
		$command->execute();
	 }

	 public function delAlbumRelations()
	 {
		$id = $this->id;
		$connection = Yii::app()->db;
		$sql = "UPDATE album_image SET status = :disabled
				WHERE album_id = :album_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":album_id", $id);
		$command = $command->bindParam(":disabled", $this->statusDisabled);
		$command->execute();
	 }
	 public function delAlbum()
	 {
		$id = $this->id;
		$connection = Yii::app()->db;
		$sql = "UPDATE album SET status = :disabled
				WHERE id = :album_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":album_id", $id);
		$command = $command->bindParam(":disabled", $this->statusDisabled);
		$command->execute();
	 }
	 public function delAlbumImageRelation($pid)
	 {
		$id = $this->id;
		$connection = Yii::app()->db;
		$sql = "UPDATE album_image SET status = :disabled
				WHERE album_id = :album_id AND image_id = :image_id";
		$command = $connection->createCommand($sql);
		$command = $command->bindParam(":album_id", $id);
		$command = $command->bindParam(":image_id", $pid);
		$command = $command->bindParam(":disabled", $this->statusDisabled);
		$command->execute();
	 }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, image_id, title, timestamp', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'image_id' => 'Image',
			'title' => 'Title',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
