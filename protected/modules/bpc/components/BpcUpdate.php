<?php

class BpcUpdate {

	private $news;
	private $event;
	private $MAX_INGRESS_LENGTH = 700;

	public function update($bpcID) {
		$postData = array(
			'request' => 'get_events',
			'event' => $bpcID,
		);
		$response = $this->getBpcResponse($postData);
		if (isset($response['event'][0])) {
			$event = $response['event'][0];
			$this->updateBedpres($event);
		}
	}
	
	protected function getBpcResponse($postdata) {
		$request = new BpcRequest($postdata);
		$request->send();
		return $request->getResponse();
	}

	public function updateAll() {
		$postData = array(
			'request' => 'get_events',
		);
		$response = $this->getBpcResponse($postData);
		$this->updateAllBedpresses($response);
	}

	private function updateAllBedpresses($data) {
		if (!isset($data['event'])) {
			return;
		}
		foreach ($data['event'] as $event) {
			$this->updateBedpres($event);
		}
	}

	private function updateBedpres($bedpresData) {
		$this->init($bedpresData['id']);
		$this->saveEvent($bedpresData);
		$this->saveNews($bedpresData);
	}

	public function init($bpcID) {
		$this->initEvent($bpcID);
		$this->initNews();
	}

	private function initEvent($bpcID) {
		$bedpress = EventCompany::model()->with('event')->find('bpcID = ?',array($bpcID));
		$event = false;
		if ($bedpress) {
			$event = $bedpress->event;
		}
		if ($event) {
			$this->event = $event;
		} else {
			$this->event = new Event;
		}
	}

	private function initNews() {
		if (!$this->event->isNewRecord) {
			$this->initNewsByEvent();
		} else {
			$this->news = new News;
		}
	}

	private function initNewsByEvent() {
		$news = News::model()->find('parentId = ? AND parentType = "event"', array(
			$this->event->id
				));
		if ($news) {
			$this->news = $news;
		} else {
			$this->news = new News;
		}
	}

	private function saveEvent($bpc) {
		$event = $this->event;
		$event->start = $bpc['time'];
		$event->end = $bpc['time']; // FIXME
		$event->location = $bpc['place'];
		$event->save();
		$event->saveBedpress($bpc['id']);
	}

	private function saveNews($bpc) {
		$news = $this->news;
		$news->title = 'Bedpres: '.$bpc['title'];
		$news->content = $bpc['description_formatted'];
		$news->ingress = $this->shortenIngress($bpc['description']);
		$news->setParent('event', $this->event->id);
		$news->save();
		$news->authorId = null;
		$news->save();
	}
	
	private function shortenIngress($description) {
		$descriptionLength = strlen($description);
		if ($descriptionLength < $this->MAX_INGRESS_LENGTH) return $description;
		return substr($description, 0,$this->MAX_INGRESS_LENGTH) . "...";
	}
}