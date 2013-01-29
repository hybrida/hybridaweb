<?php

class AlumniController extends Controller
{
	public function actionRegister()
	{
		$model=new Alumni;

		if(isset($_POST['Alumni']))
			$model->attributes=$_POST['Alumni'];
		if($model->validate())
		{
			$news = News::model()->find("parentId = ? AND parentType = 'event'", array(
				$model->event_id,));

			if (!$news)
				$this->redirect('/');
				
			$model->save();
			$url = $this->createUrl('/news/view', array(
				'id' => $news->id,
				'title' => $news->title));
			$this->redirect($url);
		}
		
		$this->render(	'register',array('model'=>$model,
						'eid' => $model->event_id));
	}
	public function actionHybridafeirertiaarogjegharikkebrukernavn($eid)
	{
		$model=new Alumni;
		$this->render(	'register',array('model'=>$model,
						'eid' => $eid));
	}
}
