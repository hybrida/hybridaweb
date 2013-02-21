<?php

/**
 * This is the model class for table "griffgame_highscore".
 *
 * The followings are the available columns in table 'griffgame_highscore':
 * @property integer $id
 * @property integer $userId
 * @property string $timestamp
 * @property string $score
 *
 * The followings are the available model relations:
 * @property User $user
 */
class GriffgameHighscore extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GriffgameHighscore the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'griffgame_highscore';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, timestamp, score', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('score', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, timestamp, score', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'timestamp' => 'Timestamp',
			'score' => 'Score',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('score',$this->score,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getTopScores() {
		$sql =  "SELECT userId, min(score) as score
			from griffgame_highscore
			group by userId
			order by score asc
			limit 50";
		$stmt = Yii::app()->db->getPdoInstance()->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$ar = array();
		foreach ($data as $v) {
			$ar[] = self::model()->find('userId = ? AND score = ?', array($v['userId'], $v['score']));
		}
		return $ar;
	}
}