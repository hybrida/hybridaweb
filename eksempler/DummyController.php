<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DummyController
 *
 * @author sigurd
 */
class DummyController extends Controller {

	public function actionEditgroup() {
		$model = new EditGroupForm();

		if (isset($_POST['EditGroupForm'])) {
			/*
			  ?>
			  <pre><? print_r($_POST)?></pre>
			  <?

			  print_r($model);
			 */

			$model->setAttributes($_POST['EditGroupForm'], false);
			if ($model->validates()) {
				$model->save();
		}
		}
		$this->render("application.views.groups.edit", array("model" => $model));
	}

	//put your code here
}
?>
