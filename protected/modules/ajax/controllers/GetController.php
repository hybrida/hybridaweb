<?php

class GetController extends Controller {

	const AJAX_LIMIT = 10;

	public function actionGetAccessBlock($sub, $name, $id) {
		$this->widget('application.components.widgets.AccessField', array(
			'name' => $name,
			'id' => $id,
			'sub' => $sub,
			'isAjaxRequest' => true,
		));
	}

	public function actionUserSearch($usernameStartsWith) {
		if (user()->isGuest) {
			echo "[]";
			return;
		}
		$users = $this->getUsersFromSearch($usernameStartsWith);
		echo CJSON::encode($users);
	}

	private function getUsersFromSearch($usernameStartsWith) {
		$term = $this->createSearchTerm($usernameStartsWith);
		$concat = "CONCAT(firstName, ' ' , middleName, ' ', lastName)";
		$concat2 = "CONCAT(firstName, ' ', lastName)";
		$sql = sprintf(
				'username LIKE :term OR %s LIKE :term OR %s LIKE :term',
				$concat, $concat2);
		$criteria = new CDbCriteria();
		$criteria->condition = $sql;
		$criteria->params = array(
			'term' => $term,
		);
		$criteria->limit = self::AJAX_LIMIT;
		$criteria->order = "firstname asc, lastname asc";
		return User::model()->findAll($criteria);
	}

	private function getNewsFromSearch($titleLike) {
		$term = $this->createSearchTerm($titleLike);
		$criteria = new CDbCriteria();
		$criteria->condition = "title LIKE :title AND status = :status";
		$criteria->params = array(
			'title' => $term,
			'status' => Status::PUBLISHED,
		);
		$criteria->order = "title asc";
		$criteria->limit = self::AJAX_LIMIT;
		$news = News::model()->findAll($criteria);
		return $this->filterOutNonAccess($news, "news");
	}

	private function getArticlesFromSearch($titleLike) {
		$term = $this->createSearchTerm($titleLike);
		$criteria = new CDbCriteria();
		$criteria->condition = "title LIKE :title";
		$criteria->params = array(
			':title' => $term,
		);
		$criteria->order = "title asc";
		$criteria->limit = self::AJAX_LIMIT;
		//debug($criteria->toArray());
		$articles =  Article::model()->findAll($criteria);
		return $this->filterOutNonAccess($articles, "article");
	}

	private function filterOutNonAccess($models, $type) {
		return array_filter($models, function($model) use ($type) {
			if (!app()->gatekeeper->hasPostAccess($type, $model->primaryKey)) {
				return false;
			}
			return true;
		});
	}

	private function createSearchTerm($input) {
		return '%' . str_replace(' ', '% %', $input) . '%';
	}

	public function actionNewsSearch($titleLike) {
		$news = $this->getNewsFromSearch($titleLike);
		$articles = $this->getArticlesFromSearch($titleLike);
		$users = array();
		if (!user()->isGuest) {
			$users = $this->getUsersFromSearch($titleLike);
		}
		$models = array_merge($news, $articles, $users);
		echo $this->getJsonFromModels($models);
	}

	private function getJsonFromModels($models) {
		$modelsArray = array();
		foreach ($models as $model) {
			if ($model instanceof User) {
				$modelsArray[] = array(
					'viewUrl' => $model->viewUrl,
					'title' => $model->fullName,
				);
				continue;
			}

			$modelsArray[] = array(
				'viewUrl' => $model->viewUrl,
				'title' => $model->title,
			);
		}

		return CJSON::encode($modelsArray);
	}

}