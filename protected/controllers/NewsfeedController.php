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

	public function actionAtom($limit=30) {
		Yii::import('ext.efeed.*');
		$criteria = new CDbCriteria();
		$criteria->limit = $limit;
		$criteria->order = "weight DESC, timestamp DESC";
		$models = News::model()->findAll($criteria);

		$feed = new EFeed(EFeed::ATOM);

		// IMPORTANT : No need to add id for feed or channel.
		// It will be automatically created from link.
		$feed->title = 'Hybrida Nyhetsstrøm';
		$feed->link = 'http://hybrida.no';

		$feed->addChannelTag('updated', date(DATE_ATOM, time()));
		$feed->addChannelTag('author', array('name'=>'Hybrida'));

		$baseUrl = "http://hybrida.no";
		foreach ($models as $model) {
			$item = $feed->createNewItem();

			$item->title = $model->title;
			$item->link  = $baseUrl . $model->viewUrl;
			// we can also insert well formatted date strings
			$item->date = $model->timestamp;
			$item->description = $model->ingress;

			$feed->addItem($item);
		}

		$feed->generateFeed();
	}

}