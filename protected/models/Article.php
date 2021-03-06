<?php

Yii::import('application.components.widgets.ArticleTree');

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property integer $parentId
 * @property string $title
 * @property string $shorttitle
 * @property string $content
 * @property string $phpFile
 * @property integer $author
 * @property string $timestamp
 * @property array $access
 * @property integer $articleTextId
 * @property ArticleText $articleText
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
			array('shorttitle', 'length', 'max' => 15),
			array('parentId', 'numerical', 'integerOnly' => true),
			array('phpFile', 'length','max' => 30),
			array('author', 'numerical', 'integerOnly' => true),
			array('weight, title, shorttitle, content, timestamp', 'safe'),
			array('id, parentId, title, shorttitle, author, timestamp', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
			'author' => array(self::BELONGS_TO, 'user', 'author'),
			'articleText' => array(self::HAS_MANY, 'ArticleText', 'articleId'),
			//'currentArticleContent' => array(self::BELONGS_TO, "ArticleText", "articleTextId"),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'parentId' => 'parentId',
			'title' => 'Title',
			'shorttitle' => 'ShortTitle',
			'content' => 'Content',
			'phpFile' => 'phpFile',
			'author' => 'Author',
			'timestamp' => 'Timestamp',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('parentId', $this->parentId);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('shorttitle', $this->shorttitle, true);
		$criteria->compare('phpFile', $this->phpFile);
		$criteria->compare('author', $this->author);
		$criteria->compare('timestamp', $this->timestamp, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	private function setupAccessRelation() {
		$this->_access = new AccessRelation($this);
	}

	public function afterConstruct() {
		$this->setupAccessRelation();
		$this->articleText = new ArticleText;
		return parent::afterConstruct();
	}

	public function afterFind() {
		$this->setupAccessRelation();
		$this->articleText = ArticleText::model()->findByPk($this->articleTextId);
		return parent::afterFind();
	}

	public function setAccess($array) {
		$this->_access->set($array);
	}

	public function getAccess() {
		return $this->_access->get();
	}

	public function beforeSave() {
		$transaction = $this->dbConnection->beginTransaction();
		if ($this->isNewRecord) {
			$this->author = Yii::app()->user->id;
			$this->timestamp = new CDbExpression('NOW()');
		}
		if (empty($this->shorttitle)) {
			$this->shorttitle = new CDbExpression('NULL');
		}
		if (empty($this->phpFile)) {
			$this->phpFile = new CDbExpression('NULL');
		}
		$saveOK = $this->articleText->save(false);
		$this->articleTextId = $this->articleText->id;
		$this->addErrors($this->articleText->getErrors());
		$transaction->commit();
		return parent::beforeSave() && $saveOK;
	}

	public function afterSave() {
		$this->articleText->articleId = $this->id;
		$saveOK = $this->articleText->save();
		$this->addErrors($this->articleText->getErrors());
		$this->_access->replace();
		return parent::afterSave() && $saveOK;
	}

	public function purify() {
		$purifier = new CHtmlPurifier();
		$this->parentId = $purifier->purify($this->parentId);
		$this->articleText->purify();
		$this->title = $purifier->purify($this->title);
		$this->phpFile = $purifier->purify($this->phpFile);
		$this->shorttitle = $purifier->purify($this->shorttitle);
	}

	public function getChildren() {
		$children = Article::model()->findAll("parentId = :id", array(
			":id" => $this->id,
				));
		return $children;
	}

	public function getText() {
		$articleText = ArticleText::model()->findByPk($this->articleTextId);
		return $articleText->content;
	}

	public function setContent($content) {
		$this->setArticleTextContents($content);
	}

	private function setArticleTextContents($content=null, $phpFile=null) {
		$oldArt = $this->articleText;
		if ($oldArt === null) {
			$oldArt = new ArticleText;
		}
		$this->articleText = new ArticleText;
		if ($content ===null) {
			$this->articleText->content = $oldArt->content;
		} else {
			$this->articleText->content = $content;
		}
		if ($phpFile === null) {
			$this->articleText->phpFile = $oldArt->phpFile;
		} else {
			$this->articleText->phpFile = $phpFile;
		}
		$this->articleText->purify();
	}

	public function getContent() {
		return $this->articleText->content;
	}

	public function setPhpFile($phpFile) {
		$this->setArticleTextContents(null, $phpFile);
	}

	public function getPhpFile() {
		return $this->articleText->phpFile;
	}

	public function getArticleText() {
		return $this->articleText;
	}

	public static function getRootTitle($currentId, $currentParent) {
		$rootId = $currentId;

		if ($currentParent)
			$rootId = Article::traverseToRoot($currentId, $currentParent);

		return Article::model()->findByPk($rootId)->title;
	}

	private static function traverseToRoot($curId, $parId) {
		if ($parId == null) {
			return $curId;
		} else {
			$curId = $parId;
			$parArt = Article::model()->findByPk($parId);
			$parId = $parArt->parentId;
			return Article::traverseToRoot($curId, $parId);
		}
	}

	public function getPhpFilePath() {
		$protectedPath = Yii::getPathOfAlias('application');
		$root = str_replace("protected", "", $protectedPath);
		$modifiedPath = $root."files/article/".$this->phpFile.".php";

		return $modifiedPath;
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

	private static function addRootToList($root) {
		self::$list[$root->id] = $root->title;
		foreach ($root->children as $child) {
			self::addNodeToList($child, $root->title);
		}
	}

	private static function addNodeToList($node, $prev) {
		$text = $prev . "/" . $node->title;
		self::$list[$node->id] = $text;
		foreach ($node->children as $child) {
			self::addNodeToList($child, $text);
		}
	}

	public function getCrumbsList() {
		$list = ArticleTree::getArticleTree();

		$que = array();
		foreach ($list as $node) {
			$que[] = new QueueNode(0, $node);
		}
		$crumbList = array();
		while(!empty($que)) {
			$queNode = array_pop($que);
			$this->updateCrumbList($crumbList, $queNode);
			if ($queNode->node->id == $this->id) {
				return $this->createCrumbs($crumbList);
			}
			foreach ($queNode->node->children as $child) {
				$que[] = new QueueNode($queNode->level + 1, $child);
			}
		}
		return array();
	}

	private function updateCrumbList(&$crumbList, $queNode) {
		while (count($crumbList) > $queNode->level && count($crumbList) != 0) {
			array_pop($crumbList);
		}
		array_push($crumbList, $queNode);
	}

	private function createCrumbs($crumbList) {
		$list = array();
		foreach ($crumbList as $queNode) {
			$node = $queNode->node;
			$list[$node->title] = Yii::app()->createUrl("/article/view", array(
				'title' => $node->title,
				'id' => $node->id,
			));
		}
		return $list;
	}

}

class QueueNode {
	public $level;
	public $node;

	public function __construct($level, $node) {
		$this->level = $level;
		$this->node = $node;
	}
}
