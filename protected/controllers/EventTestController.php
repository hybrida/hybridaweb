<?php

class EventTestController extends Controller {

	public function actionIndex() {
		
		$db = Yii::app()->db; 
		
		$q = $db->createCommand("SELECT * FROM event WHERE id = ?");
		$g = $q->query(array("' or '1'='1"));
		
		$rows = $g->readAll();
		
		
		
		
		
		$this->render('index',array('row'=>$rows));
	}

	// Uncomment the following methods and override them if needed
	/*
	  public function filters()
	  {
	  // return the filter configuration for this controller, e.g.:
	  return array(
	  'inlineFilterName',
	  array(
	  'class'=>'path.to.FilterClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }

	  public function actions()
	  {
	  // return external action classes, e.g.:
	  return array(
	  'action1'=>'path.to.ActionClass',
	  'action2'=>array(
	  'class'=>'path.to.AnotherActionClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }
	 */
}