<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property integer $menu
 * @property string $title
 * @property integer $admin
 * @property string $committee
 */
class Groups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Groups the static model class
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
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('menu, admin', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('committee', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu, title, admin, committee', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu' => 'Menu',
			'title' => 'Title',
			'admin' => 'Admin',
			'committee' => 'Committee',
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
		$criteria->compare('menu',$this->menu);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('admin',$this->admin);
		$criteria->compare('committee',$this->committee,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function addMember($userId, $commission=null) {
		$this->removeMember($userId);
		$ms = new GroupMembership;
		$ms->groupId = $this->id;
		$ms->userId = $userId;
		$ms->comission = $commission;
		$ms->start = new CDbExpression("NOW()");
		$ms->end = null;
		return $ms->save();
	}
	
	public function removeMember($userId) {
		$condition = "userId = :userId AND groupId = :groupId AND end is null";
		$params = array(
			'userId' => $userId,
			'groupId' => $this->id,
		);
		$memberships = GroupMembership::model()->findAll($condition, $params);
		foreach ($memberships as $ms) {
			$ms->end = new CDbExpression('NOW()');
			$ms->save();
		}
	}
}