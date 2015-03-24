<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:53
 *
 * This is the model class for table "poll".
 *
 * The followings are the available columns in table 'poll':
 * @property integer $id
 * @property integer $ownerId
 * @property string $title
 * @property string $status
 * @property string $public
 */

class Poll extends CActiveRecord {

    const STATUSES = 'hidden,enabled,disabled';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('title', 'length', 'max' => 30),
            array('status', 'in', 'range' => explode(',', Poll::STATUSES)),
            array('public', 'in', 'range' => array('true', 'false')),
        );
    }

    public function beforeSave() {
        $transaction = $this->dbConnection->beginTransaction();
        if ($this->isNewRecord) {
            $this->ownerId = Yii::app()->user->id;
        }
        $transaction->commit();
        return parent::beforeSave();
    }

    public function purify() {
        $purifier = new CHtmlPurifier();
        $this->title = $purifier->purify($this->title);
        $this->status = $purifier->purify($this->status);
        $this->public = $purifier->purify($this->public);
    }

    public function getVoteUrl() {
        return Yii::app()->createUrl("poll/vote", array(
            "id" => $this->id,
        ));
    }

    public function getEditUrl() {
        return Yii::app()->createUrl("poll/edit", array(
            "id" => $this->id,
        ));
    }

    public static function userHasAdminRights($pollId, $userId, $pdo = null) {
        if (is_null($pdo)) $pdo = Yii::app()->db->getPdoInstance();
        $data = array('pollId' => $pollId, 'userId' => $userId);
        $sql = "SELECT count(*) FROM `poll_admin_owner` WHERE `pollId` = :pollId AND `userId` = :userId;";
        $query = $pdo->prepare($sql);
        $query->execute($data);

        return $query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    public static function userCanSeeResults($pollId, $userId) {
        $pdo = Yii::app()->db->getPdoInstance();

        if (Poll::userHasAdminRights($pollId, $userId, $pdo)) return true;

        $data = array('pollId' => $pollId);
        $sql = "SELECT count(*) FROM `poll` WHERE `pollId` = ':pollId' AND `public` = 'true';";
        $query = $pdo->prepare($sql);
        $query->execute($data);

        return $query->fetch(PDO::FETCH_NUM)[0] > 0;
    }



}