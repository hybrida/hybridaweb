<?php

/**
 * This is the model class for table "quiz_event".
 *
 * The followings are the available columns in table 'quiz_event':
 * @property integer $id
 * @property integer $responsibleQuizTeamId
 * @property string $eventSummary
 * @property string $eventDate
 *
 * The followings are the available model relations:
 * @property QuizTeam $responsibleQuizTeam
 * @property QuizTeamScore[] $quizTeamScores
 */
class QuizEvent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuizEvent the static model class
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
		return 'quiz_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('responsibleQuizTeamId, eventSummary, eventDate', 'required'),
			array('responsibleQuizTeamId', 'numerical', 'integerOnly'=>true),
			array('eventSummary', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, responsibleQuizTeamId, eventSummary, eventDate', 'safe', 'on'=>'search'),
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
			'responsibleQuizTeam' => array(self::BELONGS_TO, 'QuizTeam', 'responsibleQuizTeamId'),
			'quizTeamScores' => array(self::HAS_MANY, 'QuizTeamScore', 'quizEventId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'responsibleQuizTeamId' => 'Responsible Quiz Team',
			'eventSummary' => 'Event Summary',
			'eventDate' => 'Event Date',
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
		$criteria->compare('responsibleQuizTeamId',$this->responsibleQuizTeamId);
		$criteria->compare('eventSummary',$this->eventSummary,true);
		$criteria->compare('eventDate',$this->eventDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}