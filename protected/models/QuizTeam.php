<?php

/**
 * This is the model class for table "quiz_team".
 *
 * The followings are the available columns in table 'quiz_team':
 * @property integer $id
 * @property string $name
 * @property string $foundedDate
 *
 * The followings are the available model relations:
 * @property QuizEvent[] $quizEvents
 * @property QuizTeamMember[] $quizTeamMembers
 * @property QuizTeamScore[] $quizTeamScores
 */
class QuizTeam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuizTeam the static model class
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
		return 'quiz_team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, foundedDate', 'required'),
			array('name', 'length', 'max'=>75),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, foundedDate', 'safe', 'on'=>'search'),
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
			'quizEvents' => array(self::HAS_MANY, 'QuizEvent', 'responsibleQuizTeamId'),
			'quizTeamMembers' => array(self::HAS_MANY, 'QuizTeamMember', 'quizTeamId'),
			'quizTeamScores' => array(self::HAS_MANY, 'QuizTeamScore', 'quizTeamId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'foundedDate' => 'Founded Date',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('foundedDate',$this->foundedDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}