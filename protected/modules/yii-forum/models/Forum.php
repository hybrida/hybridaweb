<?php

/**
 * This is the model class for table "forum".
 *
 * The followings are the available columns in table 'forum':
 * @property integer $id
 * @property integer $parent_id Parent forum. If null, this is a category
 * @property string $title Forum title
 * @property string $description Forum description
 * @property integer $listorder
 * @property boolean $is_locked Create new threads in forum? (ignored for categories)
 *
 * The followings are the available model relations:
 * @property Forum[] $subforums
 * @property Thread[] $threads
 */
class Forum extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'forum';
    }

    /**
     * @return array primary key of the table
     * */
    public function primaryKey() {
        return array('id');
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('title', 'length', 'max'=>120),
            array('parent_id, description, is_locked', 'safe'),
            array('listorder', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('title, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Default scope to always apply to this model
     */
    public function defaultScope()
    {
            return array(
                'order'=>'listorder, title',
            );
    }


    public function scopes()
    {
        $t = $this->getTableAlias(false);
        return array(
            'categories'=>array(
                'condition'=>"$t.parent_id IS NULL",
            ),
        );
    }
    // A named scope with parameter
    public function forums($parent)
    {
        $t = $this->getTableAlias(false);
        $this->getDbCriteria()->mergeWith(array(
            'condition'=>"$t.parent_id=$parent",
        ));
        return $this;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent'=>array(self::BELONGS_TO, 'Forum', 'parent_id'),

            'subforums'=>array(self::HAS_MANY, 'Forum', 'parent_id', 'order'=>'listorder,title'),
            'subforumCount'=>array(self::STAT, 'Forum', 'parent_id'),

            // 'categories'=>array(self::HAS_MANY, 'Forum', 'parent_id', 'condition'=>'type='.self::TYPE_CATEGORY),
            // 'subforums'=>array(self::HAS_MANY, 'Forum', 'parent_id', 'condition'=>'type='.self::TYPE_FORUM, 'order'=>'listorder,title'),
            // 'subforumCount'=>array(self::STAT, 'Forum', 'parent_id', 'condition'=>'type='.self::TYPE_FORUM),

            // 'threads'=>array(self::HAS_MANY, 'Thread', 'forum_id', 'order'=>'is_sticky, created'),
            'threadCount'=>array(self::STAT, 'Thread', 'forum_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), array(
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title'=>'Title',
            'description'=>'Description',
            'listorder' => 'Listorder',
            'is_locaked' => 'Is locked?',
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Return the url to this forum
     */
    public function getUrl()
    {
        return Yii::app()->createUrl('/forum/forum/view', array('id'=>$this->id));
    }

    /**
     * Returns breadcrumbs array to this forum
     */
    public function getBreadcrumbs($currentlink=false)
    {
        // Get the "path" from our parent to null
        $breadcrumbs = array();
        $forum = $this;
        while(null != $forum->parent_id)
        {
            $forum = Forum::model()->findByPk($forum->parent_id);
            $breadcrumbs[$forum->title] = array('/forum/forum/view', 'id'=>$forum->id);
        }

        $breadcrumbs = array_merge(
            array('Forum'=>array('/forum')),
            array_reverse($breadcrumbs)
        );

        if(!$this->isNewRecord)
        {
            $breadcrumbs = array_merge($breadcrumbs, $currentlink
               ?array(CHtml::encode($this->title)=>array('/forum/forum/view','id'=>$this->id))
               :array(CHtml::encode($this->title))
            );
        }
        return $breadcrumbs;
    }

    /**
     * Return the total number of posts in all threads in this forum
     */
    public function getPostCount()
    {
        return Yii::app()->db->createCommand()
            ->select('count(*) as num')
            ->from(Post::model()->tableName() .' p')
            ->join(Thread::model()->tableName() .' t', 't.id=p.thread_id')
            ->where('t.forum_id=:id', array(':id'=>$this->id))
            ->queryScalar();
    }

    /**
     * Return the last post in any of the threads in this forum (or null)
     */
    public function getLastPost()
    {
        // There's gotta be an easier, or at least more direct way to do this
        $id = Yii::app()->db->createCommand()
            ->select('p.id')
            ->from(Post::model()->tableName() .' p')
            ->join(Thread::model()->tableName() .' t', 't.id=p.thread_id')
            ->where('t.forum_id=:id', array(':id'=>$this->id))
            ->order('p.created DESC')
            ->limit(1)
            ->queryScalar();

        return Post::model()->findByPk($id);
    }

    /**
     * This gets rendered in the forum table.
     * Showing forum title, with link to forum, forum description and a list of sub forums
     * if applicable.
     */
    public function renderForumCell()
    {
        $result =
            '<div class="name">'. CHtml::link(CHtml::encode($this->title), $this->url) .'</div>'.
            '<div class="level2">'. $this->description .'</div>';

        $subforums = $this->subforums;
        if($subforums)
        {
            $subarr = array();
            foreach($subforums as $forum)
            {
                $subarr[] = CHtml::link(CHtml::encode($forum->title), $forum->url);
            }
            $result .= '<div class="level3"><b>Sub forums:</b> '. implode(', ', $subarr) .'</div>';
        }
        return $result;
    }

    /**
     * This gets rendered in the forum table.
     * Showing last post subject, with link to it, time of post, and name of poster, with link.
     */
    public function renderLastpostCell()
    {
        $lastpost = $this->lastPost;
        if(null == $lastpost) return '<div style="text-align:center;">-</div>';

        $thread = $lastpost->thread;
        $author = $lastpost->author;

        $threadlink = CHtml::link(CHtml::encode($thread->subject), $thread->url);
        $authorlink = CHtml::link(CHtml::encode($author->name), $author->url);

        return '<div class="name">'. $threadlink .'</div>'.
                '<div class="level2">'. Yii::app()->controller->module->format_date($lastpost->created) .'</div>'.
                '<div class="level3">by '. $authorlink .'</div>';
    }

}
