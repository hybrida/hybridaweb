<?php



class FrontpageBannerController extends Controller {

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('index'),
				'roles' => array('admin'),
			),
			array('deny'),
		);
	}

	public function actionIndex() {

		$model = new FrontpageBanner;

		debug($_POST);
		if(isset($_POST['FrontpageBanner'])) {
			$model->attributes=$_POST['FrontpageBanner'];
			if($model->validate(array("timestamp", "title"))) {
				$image = Image::uploadByModel($model, 'imageUpload', user()->id);
				$model->imageId = $image->id;
				if ($model->validate()) {
					$model->save();
					$this->redirect($this->createUrl("all"));
				} else {
					debug($model->getErrors(), "inner");
				}
			} else {
				debug($model->getErrors(), "outer");
			}
		}
		$this->render('index', array(
			'model' => $model,
		));
	}

	public function actionAll() {
		$models = FrontpageBanner::model()->findAll();
		$this->render('all', array(
			'models' => $models,
		));
	}

}
