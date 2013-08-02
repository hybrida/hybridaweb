<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->renderPartial('index');
	}

	public function actionTask2_super_top_secret_underground_abcdefghijklmnopqrsteuvwxyz_boom_qwfpgj() {
		$hacker = new PHPHacker;
		$answer = null;

		if (Yii::app()->request->isPostRequest) {
			$hacker->php = $_POST['PHPHacker']['php'];
			$answer = $hacker->runCode();
		}

		$condition = new CDbCriteria;
		$condition->limit = 2;
		$condition->order = "id DESC";
		$this->render('task2', array(
			'hacker' => $hacker,
			'answer' => $answer,
			'output' => $hacker->output,
			'hacks' => Inject::model()->findAll($condition),
		));

	}

	public function actionTask3_super_secret() {
		$inject = new Inject;
		if (Yii::app()->request->isPostRequest) {
			$inject->setAttributes($_POST['Inject']);
			$inject->save();
			user()->setFlash("success", "Du har nå ødelagt for de andre");
		}
		$this->render('task3', array(
			'inject' => new Inject,
		));

	}
}