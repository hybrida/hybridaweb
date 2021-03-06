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
				array('allow',
					'actions'=>array('clear', 'create','update', 'upload', 'delete', 'picdelete'),
					'users'=>array('@'),
					),
				array('allow',
					'actions' => array('index','view', 'picview', 'ajax' ),
					'users'=>array('*'),
					),

				array('deny',  // deny all users
					'users'=>array('*'),
					),
				);
	}

	public function actionIndex()
	{
		$this->pageTitle = ("Galleri");
		$criteria=new CDbCriteria;
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>Status::PUBLISHED);
		$criteria->order = 'id DESC';
		$allAlbums = Album::model()->findAll($criteria);
		$albums = array();
		foreach($allAlbums as $album)
			if ($album->hasViewAccess())
				$albums[] = $album;
		foreach($albums as $album)
			$album->getImages();
		$this->render('index',array(
					'albums'=> $albums,
					'isLoggedIn' => !user()->isGuest,
					));
	}

	public function actionView($id)
	{
		$album = $this->loadModel($id);
		if(!$album->hasViewAccess())
			throw new CHttpException(403,'Invalid request. Please do not repeat this request again.');
		$album->getImages();
		$canDelete = $album->hasDeleteAccess();
		$this->pageTitle = ($album->title);

		$this->render('view',array(
					'album'=> $album,
					'canDelete' => $canDelete,
					'isLoggedIn' => !user()->isGuest,
					));
	}

	public function actionPicview($id, $pid)
	{
		$album = $this->loadModel($id);
		if(!$album->hasViewAccess())
			throw new CHttpException(403,'Invalid request. Please do not repeat this request again.');
		$album->getImages();
		$this->pageTitle = ($album->title);

		$image = Image::model()->findByPk($pid);

		if ($image && in_array($image, $album->images)) {
			$userId = $image->userId;
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
		$canDelete = $image->hasDeleteAccess();
		$userModel = User::model()->findByPk($userId);
		$user = $userModel->getFullName();
		$index =array_search($image, $album->images);
		$num =count($album->images);
		if ($index + 1 < $num)
			$nextID = $index+1;
		else
			$nextID = -1;

		if ($index > 0)
			$prevID = $index-1;
		else
			$prevID = -1;

		$this->render('picview',array(
					'album'=>$album,
					'image'=>$image,
					'user' => $user,
					'index' => $index,
					'num' => $num,
					'nextID' => $nextID,
					'prevID' => $prevID,
					'canDelete' => $canDelete,
					));
	}

	public function actionAjax($id, $pid)
	{
		$data = array();
		$album = $this->loadModel($id);
		$album->getImages();
		$image = Image::model()->findByPk($pid);
		$userId = $image->userId;
		$userModel = User::model()->findByPk($userId);
		$userName = $userModel->getFullName();
		$index =array_search($image, $album->images);
		$num =count($album->images);

		if (!$image->hasSize("gallery_big"))
			$image->resize("gallery_big");

		$data['albumID'] = $album->id;
		$data['imageID'] = $image->id;
		$data['timestamp'] = $image->timestamp;
		$data['index'] = $index;
		$data['num'] = $num;
		$data['userName'] = $userName;
		$data['fullURL'] = Image::getRelativeFilePath($image->id, "original");
		$data['bigURL'] = Image::getRelativeFilePath($image->id, "gallery_big");
		$data['comments'] = $this->widget('comment.components.CommentWidget', array( 'id' => $image->id, 'type' => 'gallery',));

		$data['deleteAble'] = $image->hasDeleteAccess();
		if ($index + 1 < $num)
			$data['nextID'] = $album->images[$index+1]->id;
		else
			$data['nextID'] = -1;

		if ($index > 0)
			$data['prevID'] = $album->images[$index-1]->id;
		else
			$data['prevID'] = -1;
		echo str_replace('\/','/',json_encode($data));
	}

	public function actionCreate()
	{
		$model=new Album;
		$errors = array();
		$this->pageTitle = ("Nytt album");

		$imageIDs = $this->getUploads();
		if(isset($_POST['Album']))
		{

			$model->attributes = $_POST['Album'];
			$model->user_id = Yii::app()->user->id;
			$imageIDs = $this->getUploads();

			if($model->save())
			{
				foreach ($imageIDs as $imageID) {
					$model->addAlbumImageRelation($imageID);
				}
				$this->clearUploads();

				$newsModel = new News();
				$newsModel->parentId = $model->id;
				$newsModel->parentType = 'album';
				$newsModel->authorId = $model->user_id;
				$newsModel->save();

				$this->redirect('/galleri/'.$model->id);
			}
			else {
				$errors[] = "Albumet må ha tittel";
			}
		}
		if (count($imageIDs) > 0) {
			$errors[] = count($imageIDs) . " bilder er allerede lastet opp. Du trenger
												ikke laste opp disse på nytt";
			$errors[] = "Trykk " . CHtml::link('her', '#',
					array( 'submit' => array('clear', 'id' => $model->id)))
					. " om du ikke vil ha med disse bildene";
			}

		$this->render('create',array(
					'model'=>$model,
					'errors' => $errors,
					));
	}

	public function actionClear($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->clearUploads();
			if ($id > 0)
				$this->redirect('/galleri/update/'.$id);
			else
				$this->redirect('/galleri/create');
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionUpdate($id)
	{
		$this->pageTitle = "Last opp";
		$model=$this->loadModel($id);
		$model->getImages();
		$errors = array();
		$imageIDs = $this->getUploads();
		if(isset($_POST['Album']))
		{

			$model->attributes = $_POST['Album'];

			if($model->save())
			{
				foreach ($imageIDs as $imageID) {
					$model->addAlbumImageRelation($imageID);
				}
				$this->clearUploads();
				$this->redirect('/galleri/'.$model->id);
			}
			else {
				$errors[] = "Albumet må ha tittel";
			}
		}
		if (count($imageIDs) > 0) {
			$errors[] = count($imageIDs) . " bilder er allerede lastet opp. Du trenger
												ikke laste opp disse på nytt";
			$errors[] = "Trykk " . CHtml::link('her', '#',
					array( 'submit' => array('clear', 'id' => $model->id)))
					. " om du ikke vil ha med disse bildene";
			}

		$this->render('update',array(
					'model'=>$model,
					'errors' => $errors,
					'canDelete' => $model->hasDeleteAccess(),
					));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);

			if (!$model->hasDeleteAccess())
				throw new CHttpException(403,'Invalid request. Please do not repeat this request again.');

			$model->delAlbumRelations();
			$model->delAlbum();

			$this->redirect('/galleri/');
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionPicdelete($id, $pid)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			$image = Image::model()->findByPk($pid);

			if (!$image->hasDeleteAccess())
				throw new CHttpException(403,'Invalid request. Please do not repeat this request again.');

			$model->delAlbumImageRelation($pid);

			$this->redirect('/galleri/'.$model->id);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	private function getUploads()
	{
		// Read files
		$files = array();
		if (Yii::app()->user->hasState("uploadedfile")) {
			$files = Yii::app()->user->getState("uploadedfile");
		}

		return $files;
	}

	private function clearUploads()
	{
		// Clear files
		if (Yii::app()->user->hasState("uploadedfile")) {
			Yii::app()->user->setState('uploadedfile', null);
		}
	}

	public function loadModel($id)
	{
		$model=Album::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
		@set_time_limit(60 * 60);
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
					@unlink($_FILES['file']['tmp_name']);
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

			$exploded = explode('.', $fileName);
			$end = end($exploded);
			$ext = strtolower($end);

			if (in_array($ext, array('png', 'jpg', 'jpeg', 'gif')))
			{
				$user = Yii::app()->user;
				$fullName = $targetDir. DIRECTORY_SEPARATOR . $fileName;
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
}
