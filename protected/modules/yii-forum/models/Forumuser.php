<?php

/**
 * This is the model class for table "forumuser".
 *
 * The followings are the available columns in table 'forumuser':
 * @property integer $id The id of the user as used inside this module
 * @property string $siteid The id of the user as used in the rest of the site
 * @property string $name User name
 *
 * The followings are the available model relations:
 * @property Post[] $posts List of posts user has authored
 * @property integer $postCount Number of posts user has authored
 */
class Forumuser extends CActiveRecord
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
        return 'forumuser';
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
            array('signature', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'posts'=>array(self::HAS_MANY, 'Post', 'author_id'),
            'postCount'=>array(self::STAT, 'Post', 'author_id'),
        );
    }

    /**
     * Return the url to this user
     */
    public function getUrl()
    {
        return Yii::app()->createUrl('/forum/user/view', array('id'=>$this->id));
    }
}
