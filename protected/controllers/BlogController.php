<?php
	class BlogController extends Controller {

		public function isUserAWriter($userId) {
			$con = Yii::app()->db;
			$sql = "SELECT COUNT(userId) FROM blog_writers WHERE userId = $userId";
			$com = $con->createCommand($sql);
			$val = $com->query()->read();
			return $val;
		}

		public function actionIndex() {
			$this->layout = "//layouts/singleColumn";
			$model = new Blog;
			$data = $model->getLatestPosts();

			if (isset(Yii::app()->user->id)) {
				if ($this->isUserAWriter(Yii::app()->user->id)) {
					$formdata = new BlogPost;
					if ($formdata->isDataPosted()) {
						$val = $formdata->validateData();
						if ($val) {
							$formdata->uploadToDataBase();
						}
						$this->render("post_feedback", array("data" => $val));
					}
					else {
						echo "Rendering with post form";
						$this->render("blog_with_post_form", array("data" => $data, "formdata" => $formdata));
					}
				}
				else {
					echo "Rendering without post form";
					$this->render("blog_no_post");
				}
			}
			else {
				echo "Rendering";
				$this->render("blog", array("data" => $data));
			}
		}

		public function actionPost() {
			$this->render("newpost");
		}
	}