<?php

class VersionController extends Controller {

	const githubPrefix = "https://github.com/hybrida/hybridaweb/commit/";

	public function actionIndex() {
		$hash = $this->getHash();
		$githubUrl = self::githubPrefix . $hash;

		$this->render('index', array(
			'hash' => $hash,
			'url' => $githubUrl,
		));
	}

	private function getHash() {
		return exec("git rev-parse HEAD");
	}

	public function actionHash() {
		echo $this->getHash();
	}

}
