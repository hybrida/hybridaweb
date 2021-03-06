<?php

Yii::import("timetracker.models.*");

class DefaultController extends Controller
{
	public function userHasAccess() {
		return !Yii::app()->user->isGuest && TrackerUser::model()->findByPk(user()->id) != NULL;
	}

    private function checkAccess() {
        if (!$this->userHasAccess()) {
			throw new CHttpException(403, "Du har ikke lov til å komme inn hit");
        }
    }

    public function actionIndex() {
        $this->checkAccess();
        $graph = new TrackGraph(14);

		$this->render('index', array(
            'series' => $graph->getSeries(),
            'dates' => $graph->getDates(),
            'history' => $graph->getHistory(),
        ));
	}

	public function actionForm() {
        $this->checkAccess();
        if (!$this->userHasAccess()) {

        }
        $model=new TrackerLog;
        $model->user_id = user()->id;


        if(isset($_POST['TrackerLog']))  {
            $model->attributes=$_POST['TrackerLog'];
            if($model->validate())  {
                $model->save();
                $this->redirect($this->createUrl("index"));
            }
        }
        $this->render('_form',array('model'=>$model));
    }
}