<?php

/**
 * This is the model class for table "quiz_team_score".
 *
 * The followings are the available columns in table 'quiz_team_score':
 * @property integer $id
 * @property integer $quizEventId
 * @property integer $quizTeamId
 * @property string $score
 *
 * The followings are the available model relations:
 * @property QuizEvent $quizEvent
 * @property QuizTeam $quizTeam
 */
class QuizTeamScore extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuizTeamScore the static model class
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
		return 'quiz_team_score';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quizEventId, quizTeamId, score', 'required'),
			array('quizEventId, quizTeamId', 'numerical', 'integerOnly'=>true),
			array('score', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quizEventId, quizTeamId, score', 'safe', 'on'=>'search'),
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
			'quizEvent' => array(self::BELONGS_TO, 'QuizEvent', 'quizEventId'),
			'quizTeam' => array(self::BELONGS_TO, 'QuizTeam', 'quizTeamId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quizEventId' => 'Quiz Event',
			'quizTeamId' => 'Quiz Team',
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
		$criteria->compare('quizEventId',$this->quizEventId);
		$criteria->compare('quizTeamId',$this->quizTeamId);
		$criteria->compare('score',$this->score,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}