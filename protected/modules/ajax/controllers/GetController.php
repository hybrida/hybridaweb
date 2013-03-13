<?php

class GetController extends Controller {

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
		$username = $this->removeEvilCharacters($usernameStartsWith);
		$term = "'" . $username . "%'";
		$sql = sprintf(
				'username LIKE %s OR firstName LIKE %s OR lastName LIKE %s',
				$term, $term, $term);
		$criteria = new CDbCriteria();
		$criteria->condition = $sql;
		$criteria->limit = 7;
		$criteria->order = "firstname asc, lastname asc";
		return User::model()->findAll($criteria);
	}

	private function getNewsFromSearch($titleLike) {
		$title = $this->removeEvilCharacters($titleLike);
		$term = "'%" . $title . "%'";
		$securitySql = sprintf("status = %d ", Status::PUBLISHED);
		$newsSql = sprintf("title LIKE %s AND (%s)", $term, $securitySql);
		$criteria = new CDbCriteria();
		$criteria->condition = $newsSql;
		$criteria->order = "title asc";
		$criteria->limit = 7;
		$news = News::model()->findAll($criteria);
		return $this->filterOutNonAccess($news, "news");
	}

	private function getArticlesFromSearch($titleLike) {
		$title = $this->removeEvilCharacters($titleLike);
		$term = "'%" . $title . "%'";
		$articleSql = sprintf("title LIKE %s", $term);
		$criteria = new CDbCriteria();
		$criteria->condition = $articleSql;
		$criteria->order = "title asc";
		$criteria->limit = 7;
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

	private function removeEvilCharacters($input) {
		return preg_replace("/[^a-zæøåA-ZÆØÅ ]*/", "", $input);
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