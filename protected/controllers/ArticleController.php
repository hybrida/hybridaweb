<?php

class ArticleController extends Controller {

	public function actionView($id) {
		$article = $this->getArticleModelAndThrowExceptionIfNullOrNotAccess($id);

		$this->render("view", array(
			'article' => $article,
			'hasEditAccess' => user()->checkAccess('updateArticle'),
		));
	}

	public function actionCreate($parentId = null) {
		if (!user()->checkAccess('createArticle')) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}

		$model = new Article;
		$model->parentId = $parentId;
		$this->renderArticleForm($model);
	}

	public function actionEdit($id) {
		if (!user()->checkAccess('updateArticle', array('id' => $id))) {
			throw new CHttpException(403, "Du har ikke tilgang");
		}

		$model = $this->getArticleModel($id);
		$this->renderArticleForm($model);
	}

	private function getArticleModelAndThrowExceptionIfNullOrNotAccess($id) {
		$article = Article::model()->findByPk($id);
		if (!$article)
			throw new CHttpException(404, 'Artikkelen finnes ikke');
		if (!app()->gatekeeper->hasPostAccess('article', $article->id))
			throw new CHttpException(403, 'Ingen tilgang');
		return $article;
	}

	private function renderArticleForm($model) {
		$form = new ArticleForm($model);
		if (isset($_POST['ArticleForm'])) {
			$form->setAttributes($_POST['ArticleForm']);
			$form->save();

			$this->redirect($form->getArticleModel()->getViewUrl());
			return;
		}

		$this->render('edit', array(
			'model' => $form,
		));
	}

	private function getArticleModel($id) {
		$model = Article::model()->findByPk($id);
		if ($model)
			return $model;
		else
			throw new CHttpException(404,"Artikkelen finnes ikke");
	}

}