<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->renderPartial('index');
	}
}