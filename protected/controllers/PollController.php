<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:38
 */

class PollController extends Controller {
    public function actionIndex() {
        $this->render("index", array('polls' => Poll::model()->findAll()));
    }

    public function actionCreate() {
        $model = new Poll;
        $model->ownerId = user()->getId();
        $this->renderPollForm($model);
    }

    public function actionEdit($id) {
        if (!Poll::userHasAdminRights($id, user()->getId())) {
            throw new CHttpException(403, "Du har ikke tilgang");
        }
        $model = $this->getPollModel($id);
        $this->renderPollForm($model);
    }

    public function actionVote($id) {
        $model = $this->getPollModel($id);
        if (!$model->status == 'hidden' && !Poll::userHasAdminRights($id, user()->getId())) {
            throw new CHttpException(403, "Avstemningen er ikke tilgjengelig");
        }
        $options = PollOption::model()->findAllByAttributes(array('pollId' => $id));

        $this->render("vote", array('model' => $model, 'options' => $options, 'voted' => null));
    }

    public function actionResults($id) {
        $this->render("results");
    }

    private function renderPollForm($model) {
        $form = new PollForm($model);
        if (isset($_POST['PollForm'])) {
            $form->setAttributes($_POST['PollForm']);
            if (isset($_))
            $form->save();

            $this->redirect($form->getPollModel()->getEditUrl());
            return;
        }

        $this->render("edit", array('model' => $form,));
    }

    private function getPollModel($id) {
        $model = Poll::model()->findByPk($id);
        if ($model) {
            return $model;
        } else {
            throw new CHttpException(404, "Avstemningen finnes ikke");
        }
    }
}