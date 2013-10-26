<?php

/**
 * This is the model class for table "tracker_log".
 *
 * The followings are the available columns in table 'tracker_log':
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $work_time
 */
class TrackerLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tracker_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, date, work_time', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('work_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, date, work_time', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'TrackerUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'date' => 'Date',
			'work_time' => 'Work Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('work_time',$this->work_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrackerLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterConstruct() {
		if ($this->isNewRecord) {
			$this->date = date('Y-m-d', time());
		}
	}

	public function beforeSave() {
		$logsFromBefore = self::model()->findAll("user_id = ? and date = ?", array(
			$this->user_id,
			$this->date,
		));
		if (count($logsFromBefore) >= 1) {
			$log = $logsFromBefore[0];
			$this->overwritePrevious($log);
			return false;
		}
		return true;
	}

	private function overwritePrevious($log) {
        // Kan ikke bruke standard $log->save() fordi det fører til en uendelig
		// rekursjon der afterValidate blir kallt gang på gang.
		$tbl = $this->tableName();
		$sql = "UPDATE ${tbl}
				SET work_time = :work_time
				WHERE user_id = :uid AND date = :date;";
		$stmt = Yii::app()->db->pdoInstance->prepare($sql);
		$stmt->bindValue(":work_time", $this->work_time);
		$stmt->bindValue(":date", $this->date);
		$stmt->bindValue(":uid", $this->user_id);
		$stmt->execute();
	}
}
