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
		$this->render('task2', array(
			'hacker' => $hacker,
			'answer' => $answer,
			'output' => $hacker->output,
		));
		
	}
	
	public function actionTask3() {
		$this->renderPartial('task3');
		
	}
}