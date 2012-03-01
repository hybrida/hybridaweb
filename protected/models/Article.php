<?php
/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $author
 * @property string $timestamp
 */
class Article extends CActiveRecord {
	private $_access;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'article';
	}

	public function rules() {
		return array(
			array('title', 'length', 'max' => 30),
			array('author', 'numerical', 'integerOnly' => true),
			array('title, content, timestamp', 'safe'),
			array('id, title, content, author, timestamp', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
			'author' => array(self::BELONGS_TO, 'hyb_user', 'author'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'author' => 'Author',
			'timestamp' => 'Timestamp',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('author', $this->author);
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
	
	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->author = Yii::app()->user->id;
			$this->timestamp = new CDbExpression('NOW()');
		}
		return parent::beforeSave();
	}
	
	public function afterSave() {
		$this->_access->replace();
		return parent::afterSave();
	}
	
	public function purify() {
		$purifier = new CHtmlPurifier();
		$this->content = $purifier->purify($this->content);
		$this->title = $purifier->purify($this->title);
		return parent::beforeValidate();
	}

	public function getAuthorName() {
		$authorId = User::model()->findByPk($this->author);
		$name = "";
		if ($authorId) {
			$name = $authorId->firstName . " " . $authorId->middleName . " " . $authorId->lastName;
		}
		return $name;
	}
	
	public function getAuthorUrl() {
		$authorId = User::model()->findByPk($this->author);
		$url = "";
		if ($authorId) {
			$url = $authorId->getViewUrl();
		}
		return $url;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getViewUrl() {
		return Yii::app()->createUrl("article/view", array(
			"id" => $this->id,
			"title" => $this->getTitleWithDelimiters(),
		));
	}
	
	private function getTitleWithDelimiters() {
		return str_replace(' ', '-', $this->title);
	}
}