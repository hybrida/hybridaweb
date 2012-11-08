<?php

class AlbumController extends Controller
{
	private $imageIDs = array();

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',	// allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'picview'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'picdelete'),
				'users'=>array('admin'),
			),
			array('deny',	// deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$album = $this->loadModel($id);
		$album->getImages();

		$this->render('view',array(
			'album'=> $album,
		));
	}

	public function actionPicview($id, $pid)
	{
		$album = $this->loadModel($id);
		$album->getImages();

		$image = Image::model()->findByPk($pid);

		$userId = $image->userId;
		$userModel = User::model()->findByPk($userId);
		$user = $userModel->getFullName();

		$this->render('picview',array(
			'album'=>$album,
			'image'=>$image,
			'user' => $user,
		));
	}

	private function trace($a)
	{
		echo Yii::trace(CVarDumper::dumpAsString($a),'vardump');
	}

	public function actionCreate()
	{
		$model=new Album;
		$errors = array();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			if ($_POST['new'] > 0)
				$model = Album::model()->findByPk($_POST['new']);

			$model->attributes=$_POST['Album'];
			$imageIDs = $this->getUploads();

			if($model->save())
			{
				foreach ($imageIDs as $imageID) {
					$model->addAlbumImageRelation($imageID);
				}
				$this->redirect('/gallery/'.$model->id);
			}
			else {
				$error[] = "Albumet må ha tittel";
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'errors' => $errors,
			'new' => 1,
		));
	}

	private function getUploads()
	{
		// Read files
		$files = array();
		if (Yii::app()->user->hasState("uploadedfile")) {
			$files = Yii::app()->user->getState("uploadedfile");
		}

		// Clear files
		if (Yii::app()->user->hasState("uploadedfile")) {
			Yii::app()->user->setState('uploadedfile', null);
		}

		return $files;
	}

	public function actionUpload()
	{
	 // HTTP headers for no cache etc
		header('Content-type: text/plain; charset=UTF-8');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		// Settings
		$targetDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "plupload";
		$cleanupTargetDir = false; // Remove old files
		$maxFileAge = 60 * 60; // Temp file age in seconds


		// 5 minutes execution time
		@set_time_limit(5 * 60);
		// usleep(5000);

		// Get parameters
		$chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
		$chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
		$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

		// Clean the fileName for security reasons
		$fileName = preg_replace('/[^\w\._\s]+/', '', $fileName);

		// Create target dir
		if (!file_exists($targetDir))
				@mkdir($targetDir);

		// Remove old temp files
		if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
				while (($file = readdir($dir)) !== false) {
						$filePath = $targetDir . DIRECTORY_SEPARATOR . $file;

						// Remove temp files if they are older than the max age
						if (preg_match('/\\.tmp$/', $file) && (filemtime($filePath) < time() - $maxFileAge))
								@unlink($filePath);
				}

				closedir($dir);
		} else
				throw new CHttpException (500, Yii::t('app', "Can't open temporary directory."));

		// Look for the content type header
		if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
				$contentType = $_SERVER["HTTP_CONTENT_TYPE"];

		if (isset($_SERVER["CONTENT_TYPE"]))
				$contentType = $_SERVER["CONTENT_TYPE"];

		if (strpos($contentType, "multipart") !== false) {
				if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
						// Open temp file
						$out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
						if ($out) {
								// Read binary input stream and append it to temp file
								$in = fopen($_FILES['file']['tmp_name'], "rb");

								if ($in) {
										while ($buff = fread($in, 4096))
												fwrite($out, $buff);
								} else
										throw new CHttpException (500, Yii::t('app', "Can't open input stream."));

								fclose($out);
								unlink($_FILES['file']['tmp_name']);
						} else
								throw new CHttpException (500, Yii::t('app', "Can't open output stream."));
				} else
						throw new CHttpException (500, Yii::t('app', "Can't move uploaded file."));
		} else {
				// Open temp file
				$out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
				if ($out) {
						// Read binary input stream and append it to temp file
						$in = fopen("php://input", "rb");

						if ($in) {
								while ($buff = fread($in, 4096))
										fwrite($out, $buff);
						} else
								throw new CHttpException (500, Yii::t('app', "Can't open input stream."));

						fclose($out);
				} else
						throw new CHttpException (500, Yii::t('app', "Can't open output stream."));
		}

		// After last chunk is received, process the file
		$ret = array('result' => '1');
		if (intval($chunk) + 1 >= intval($chunks)) {

			$originalname = $fileName;
			$errors[] = $fileName;
			if (isset($_SERVER['HTTP_CONTENT_DISPOSITION'])) {
				$arr = array();
				preg_match('@^attachment; filename="([^"]+)"@',$_SERVER['HTTP_CONTENT_DISPOSITION'],$arr);
				if (isset($arr[1]))
					$originalname = $arr[1];
			}

			// **********************************************************************************************
			// Do whatever you need with the uploaded file, which has $originalname as the original file name
			// and is located at $targetDir . DIRECTORY_SEPARATOR . $fileName
			// **********************************************************************************************

			$ext = strtolower(end(explode('.', $fileName)));

			if (in_array($ext, array('png', 'jpg', 'jpeg', 'gif')))
			{
				$user = Yii::app()->user;
				$fullName = $targetDir. "\\" . $fileName;
				if (file_exists($fullName)) {
					$image = new CUploadedFile( $fileName, $fullName, filetype($fullName), filesize($fullName), 0);
					$uploadedFile = Image::uploadAndSave($image, $user->id, true);
					$uploadedFile->resize("gallery_thumb");

					if ($user->hasState("uploadedfile"))
						$files = $user->getState("uploadedfile");
					else
						$files = array();

					if (array_search($uploadedFile->id, $files) === FALSE)
						$files[] = $uploadedFile->id;
					$user->setState("uploadedfile", $files);
				}
			}
		}

		// Return response
		//die(json_encode($ret));

		echo CJavaScript::jsonEncode($ret);
		Yii::app()->end(); 
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->getImages();
		$errors = array();

		$this->render('create',array(
			'model'=>$model,
			'errors' => $errors,
			'new' => 0,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			$model->delAlbumRelations();
			$model->delAlbum();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect('/gallery/');
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public function actionPicdelete($id, $pid)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			$model->delAlbumImageRelation($pid);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect('/gallery/'.$model->id);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>Status::PUBLISHED);
		$criteria->order = 'id DESC';
		$albums = Album::model()->findAll($criteria);
		foreach($albums as $album)
		{
			$album->getImages();
		}
		$this->render('index',array(
			'albums'=> $albums,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Album('search');
		$model->unsetAttributes();	// clear any default values
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Album::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
