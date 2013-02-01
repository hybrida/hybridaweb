<?php

class AlumniController extends Controller
{
	public function actionForm()
	{
		$model=new Alumni;
		$text = "";

		if(isset($_POST['Alumni']))
			$model->attributes=$_POST['Alumni'];
		if (!isset($model->event_id))
			$this->redirect("/");
		if($model->validate())
		{
			$model->save();
			$text = "Du er nå påmeldt";
		}
		
		$this->render(	'register',array('model'=>$model,
						'eid' => $model->event_id,
						'msg' => $text));
	}
	public function actionRegister($eid)
	{
		$model=new Alumni;
		$this->render(	'register',array('model'=>$model,
						'eid' => $eid));
	}
}
