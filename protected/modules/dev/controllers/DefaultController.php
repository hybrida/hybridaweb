<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}

	public function actionLogin($id) {
		$identity = new DefaultIdentity($id);
		if ($identity->authenticate()) {
			user()->login($identity);
			$this->redirect(user()->returnUrl);
		}
	}

	public function actionDumpNews() {
		$lipsum = new LoremIpsumGenerator();
		$i = 0;
		for ($i = 0; $i < 150; $i++) {
			$news = new News;
			$news->title = "Lipsum $i";
			$news->content = $lipsum->getContent(rand(100, 700));
			$news->ingress = $lipsum->getContent(rand(10,70));
			$news->save();
		}
		echo "Suksess: Laget $i nye dummy-elementer";
	}

	public function actionCleanDB() {
		Yii::import('application.tests.testlib.*');
		TestLib::deleteDummyData();
		echo "Database is cleaned";
	}

	public function actionInstall() {
		$install = new Install;
		$install->install();
		$this->render('install');
	}

	public function actionUpdate() {
		$install = new Install;
		$install->update();
		$this->render('update');
	}

	public function actionAdmin() {
		$admin = User::model()->find('username = "admin"');
		$id = new DefaultIdentity($admin->id);
		if ($id->authenticate()) {
			user()->login($id);
			$this->redirect(user()->returnUrl);
		}
	}

	public function actionTest() {
		$this->render('test');
	}

	public function actionAccess() {
		$this->render('testAccess');
	}

	public function actionHtml() {
		$this->renderPartial('html');
	}

	public function actionAddnotifications() {

		Yii::import('comment.models.*');

		$criteria = new CDbCriteria;
		$criteria->limit = 30;
		$users = User::model()->findAll($criteria);

		$newsList = News::model()->findAll();

		$lipsum = new LoremIpsumGenerator();

		for ($i = 0; $i < 100; $i++) {
			$user = $users[array_rand($users)];
			$news = $newsList[array_rand($newsList)];

			$comment = new Comment;
			$comment->authorId = $user->id;
			$comment->parentType = Type::NEWS;
			$comment->parentId = $news->id;
			$comment->save();
			$comment->content = "Kommentar nr: " . $comment->id . "<br/>" . $lipsum->getContent(50);
			$comment->authorId = $user->id;
			$comment->save();

			Yii::app()->notification->notifyAndAddListener(
				Type::NEWS,
				$news->id,
				Notification::STATUS_NEW_COMMENT,
				$user->id,
				$comment->id);

		}

	}

	public function actionRbacTree($parent="all") {
		$rbac = new RbacTree;
		$tree = $rbac->getTree($parent);

		$this->render('rbactree', array(
			'tree' => $tree,
			'parent' => $parent,
			'all' => $rbac->getAll(),
		));

	}

}
