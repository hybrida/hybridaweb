<?php

/**
 * This is the model class for table "quiz_team_member".
 *
 * The followings are the available columns in table 'quiz_team_member':
 * @property integer $userId
 * @property integer $quizTeamId
 *
 * The followings are the available model relations:
 * @property QuizTeam $quizTeam
 * @property User $user
 */
class QuizTeamMember extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuizTeamMember the static model class
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
		return 'quiz_team_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, quizTeamId', 'required'),
			array('userId, quizTeamId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, quizTeamId', 'safe', 'on'=>'search'),
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
			'quizTeam' => array(self::BELONGS_TO, 'QuizTeam', 'quizTeamId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'User',
			'quizTeamId' => 'Quiz Team',
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

		$criteria->compare('userId',$this->userId);
		$criteria->compare('quizTeamId',$this->quizTeamId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}