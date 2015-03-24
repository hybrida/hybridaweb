<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:53
 *
 * This is the model class for table "poll_option".
 *
 * The followings are the available columns in table 'poll_option':
 * @property integer $pollId
 * @property string $option
 */

class PollOption extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'poll_option';
    }

}