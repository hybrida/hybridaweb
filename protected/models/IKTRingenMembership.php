<?php

/**
 * The followings are the available columns in table 'iktringen_membership':
 * @property integer $id
 * @property integer $companyId
 * @property string $start
 * @property string $end
 *
 * The followings are the available model relations:
 * @property Company $company
 */
class IKTRingenMembership extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'iktringen_membership';
	}

	public function rules() {
		return array(
			array('id', 'required'),
			array('id, companyId', 'numerical', 'integerOnly' => true),
			array('start, end', 'safe'),
			array('id, companyId, start, end', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
			'company' => array(self::BELONGS_TO, 'Company', 'companyId'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'companyId' => 'Company',
			'start' => 'Start',
			'end' => 'End',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('companyId', $this->companyId);
		$criteria->compare('start', $this->start, true);
		$criteria->compare('end', $this->end, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

}