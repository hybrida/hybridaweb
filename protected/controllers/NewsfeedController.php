<?php

class NewsfeedController extends Controller {
	private $offset = 0;

	public function actionIndex() {
		$this->render("feed", array(
			'hasPublishAccess' => user()->checkAccess('createNews'),
			'jsonFeed' => $this->getFeedJSON(0, -1000, 10),
		));
	}

	public function actionRSS($limit=30) {
		Yii::import('ext.efeed.*');
		$models = $this->getRSSModels($limit);

		$feed = $this->getRSSFeed($models);

		$feed->generateFeed();
	}

	private function getRSSModels($limit) {
		$criteria = new CDbCriteria();
		$criteria->limit = $limit;
		$criteria->order = "weight DESC, timestamp DESC";
		$models = News::model()->findAll($criteria);
		return $models;
	}

	private function getRSSFeed($models) {
		$feed = new EFeed();

		$feed->title = 'Hybrida Nyhetsstrøm';
		$feed->addChannelTag('pubDate', date(DATE_RSS, time()));
		$feed->addChannelTag('link', 'http://hybrida.no');

		$baseUrl = "http://hybrida.no";
		foreach ($models as $model) {
			$item = $feed->createNewItem();

			$item->title = $model->title;
			$item->link  = $baseUrl . $model->viewUrl;
			$item->date = $model->timestamp;
			$item->description = $model->ingress;

			$feed->addItem($item);
		}
		return $feed;
	}

	public function actionFeedJSON($minTimestamp, $minWeight, $limit) {
		echo $this->getFeedJSON($minTimestamp, $minWeight, $limit);
	}

	public function getFeedJSON($minTimestamp, $minWeight, $limit) {
		$models = $this->getFeedElements();
		$output = array();
		foreach ($models as $model) {
			$ar = $model->attributes;
			$ar['author'] = $model->authorId != null;
			if ($model->author) {
				$ar['authorLink'] = CHtml::link($model->author->fullName, $model->author->viewUrl);
			}
			$ar['url'] = $model->viewUrl;
			$ar['image'] = Image::tag($model->imageId, 'frontpage');
			$ar['date'] = Html::dateToString($model->timestamp, 'mediumlong');
			$output[] = $ar;
		}
		return CJSON::encode($output);
	}

	private function getFeedElements() {
		$criteria = new CDbCriteria();
		// $criteria->limit = $limit;
		$criteria->order = "weight DESC, timestamp DESC";
		$criteria->condition = "status = " . Status::PUBLISHED;
		$models = News::model()->findAll($criteria);
		$modelsYouHaveAccessTo = array();
		foreach ($models as $model) {
			if (Yii::app()->gatekeeper->hasPostAccess('news', $model->id)) {
				$modelsYouHaveAccessTo[] = $model;
			}
		}
		return $modelsYouHaveAccessTo;
	}

}