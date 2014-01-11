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
		$models = $this->getFeedElements($limit);
		$feed = $this->getRSSFeed($models);
		$feed->generateFeed();
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
			$ar['url'] = $model->viewUrl;
			$ar['author'] = $model->authorId != null;
			if ($model->author)
				$ar['authorLink']=CHtml::link($model->author->fullName, $model->author->viewUrl);
			$ar['type'] = $model->parentType;

			switch ($ar['type']) {
				case 'event':
					$ar['image'] = Image::tag($model->imageId, 'frontpage');
					$ar['date'] = Html::dateToString($model->timestamp, 'mediumlong');
					$parent = Event::model()->findByPk($model->parentId);
					if ($parent !== NULL) {
						$ar['parent'] = $parent->attributes;
					} else {
						$ar['parent'] = NULL;
					}
					break;
				case 'album':
					Yii::app()->getModule('gallery');
					$album = Album::model()->findByPk($model->parentId);
					$album->getImages();
					$ar['parent'] = $album->attributes;
					$ar['albumUrl'] = '/gallery/' . $album->id;
					$ar['imagecount'] = count($album->images);
					foreach ($album->images as $image)
						$ar['images'][] =CHtml::link(
									Image::tag($image->id, "gallery_thumb"),
									'/gallery/'.$album->id."/".$image->id,
									array('width' => 100));
					break;
				default:
					$ar['image'] = Image::tag($model->imageId, 'frontpage');
					$ar['date'] = Html::dateToString($model->timestamp, 'mediumlong');
			}

			$output[] = $ar;
		}
		return CJSON::encode($output);
	}

	private function getFeedElements($limit=1000) {
		$criteria = new CDbCriteria();
		$criteria->limit = $limit;
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
