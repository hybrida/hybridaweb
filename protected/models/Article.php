<?php

Yii::import('application.components.widgets.ArticleTree');

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property integer $parentId
 * @property string $title
 * @property string $content
 * @property integer $author
 * @property string $timestamp
 */
class Article extends CActiveRecord {

	private $_access;
	private static $list;

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'article';
	}

	public function rules() {
		return array(
			array('title', 'length', 'max' => 30),
			array('parentId', 'numerical', 'integerOnly' => true),
			array('author', 'numerical', 'integerOnly' => true),
			array('title, content, timestamp', 'safe'),
			array('id, parentId, title, content, author, timestamp', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
			'author' => array(self::BELONGS_TO, 'user', 'author'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'parentId' => 'parentId',
			'title' => 'Title',
			'content' => 'Content',
			'author' => 'Author',
			'timestamp' => 'Timestamp',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('parentId', $this->parentId);
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
		$this->parentId = $purifier->purify($this->parentId);
		$this->content = $purifier->purify($this->content);
		$this->title = $purifier->purify($this->title);
		return parent::beforeValidate();
	}

	public function getChildren() {
		$children = Article::model()->findAll("parentId = :id", array(
			":id" => $this->id,
				));
		return $children;
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
		return Html::removeSpecialChars($this->title);
	}

	public static function getTreeList() {
		$list = ArticleTree::getArticleTree();
		self::$list[null] = '';
		foreach ($list as $root) {
			self::addRootToList($root);
		}
		return self::$list;
	}

	private function addRootToList($root) {
		self::$list[$root->id] = $root->title;
		foreach ($root->children as $child) {
			self::addNodeToList($child, $root->title);
		}
	}

	private function addNodeToList($node, $prev) {
		$text = $prev . "/" . $node->title;
		self::$list[$node->id] = $text;
		foreach ($node->children as $child) {
			self::addNodeToList($child, $text);
		}
	}

}