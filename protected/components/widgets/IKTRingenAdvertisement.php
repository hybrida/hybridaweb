<?php

class IKTRingenAdvertisement extends CWidget {

	private $models;
	private $companies;

	public function init() {
		$criteria = new CDbCriteria();
		$criteria->order = "companyName ASC";

		$this->models = IKTRingenMembership::model()->with('company')->findAll($criteria);
		$this->companies = $this->separateCompaniesFromModels($this->models);
	}

	private function separateCompaniesFromModels($IKTRingenModels) {
		$companies = array();
		foreach ($IKTRingenModels as $model) {
			$companies[] = $model->company;
		}
		return $companies;
	}

	public function run() {
		$this->render('IKTRingenAdvertisement', array(
			'companies' => $this->companies
		));
	}

}