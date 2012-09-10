<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		Yii::app()->request->redirect('/kilt/shop/');
	}
 }
