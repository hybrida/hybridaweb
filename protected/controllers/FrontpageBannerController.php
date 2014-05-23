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
				'actions' => array('index', 'all'),
				'roles' => array('admin'),
			),
			array('deny'),
		);
	}

	public function actionIndex() {
		$model = new FrontpageBanner;

		if(isset($_POST['FrontpageBanner'])) {
			$model->attributes=$_POST['FrontpageBanner'];
			if($model->validate(array("timestamp", "title"))) {
				$image = Image::uploadByModel($model, 'imageUpload', user()->id);
				$model->imageId = $image->id;
				if ($model->validate()) {
					$model->save();
					$this->redirect($this->createUrl("/newsfeed/index"));
				} else {
					debug($model->getErrors(), "Inner Error");
				}
			} else {
				debug($model->getErrors(), "Outer Error");
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
