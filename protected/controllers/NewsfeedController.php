<?php

class NewsfeedController extends Controller {
	private $feedLimit = 10;
	private $offset = 0;

	public function actionIndex() {
		$feedElements = $this->getFeedElements();
		$this->render("feed", array(
			'models' => $feedElements,
			'index' => $this->offset,
			'limit' => $this->feedLimit,
			'hasPublishAccess' => user()->checkAccess('createNews'),
		));
	}

	public function actionFeedAjax($offset = 0) {
		$feedElements = $this->getFeedElements($offset);
		$this->renderPartial('_feed', array(
			'models' => $feedElements,
			'index' => $this->offset,
			'limit' => $this->feedLimit,
		));
	}

	private function getFeedElements($offset = 0) {
		$feed = new NewsFeed($this->feedLimit, $offset);
		$elements = $feed->getElements();
		$this->offset = $feed->getOffset();

		return $elements;
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
		$models = $this->getFeedElements2($minTimestamp, $minWeight, $limit);
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
		echo CJSON::encode($output);
	}

	private function getFeedElements2($maxTimestamp, $maxWeight, $limit) {
		$criteria = new CDbCriteria();
		// $criteria->limit = $limit;
		$criteria->order = "weight DESC, timestamp DESC";
		return News::model()->findAll($criteria);
	}

}