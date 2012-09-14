<?php

function getDirContents($folderPath) {
	$dirHandle = opendir($folderPath);
	$file = readdir($dirHandle);
	$files = array();
	while ($file) {
		if ($file != "." && $file != "..") {
			$files[] = $file;
		}
		$file = readdir($dirHandle);
	}
	return $files;
}

function referatFolderComparator($folder1, $folder2) {
	$yearDiff = $folder2->year - $folder1->year;
	if ($yearDiff == 0) {
		if ($folder2->season == 'v') return 1;
		return -1;
	}
	return $yearDiff;
}

function referatComparator($ref1, $ref2) {
	return $ref1->time - $ref2->time;
}

class ReferatFolder {

	public $referater;
	public $year;
	public $season;
	public $path;
	public $yearSeason;

	public function __construct($path) {
		$this->path = $path;
		$this->setDate($path);
		$this->setReferater($path);
		$this->sortReferater();
	}

	private function setDate($path) {
		$date = explode("/", $path);
		$this->yearSeason = $date[count($date) - 1];
		$this->year = substr($this->yearSeason, 0, 4);
		$this->season = substr($this->yearSeason, 4) == "v" ? "Vår" : "Høst";
	}

	private function setReferater($path) {
		$referater = getDirContents($path);
		foreach ($referater as $ref) {
			$this->referater[] = new Referat($ref);
		}
	}
	
	private function sortReferater() {
		usort($this->referater, "referatComparator");
	}

}

class Referat {

	public $fileName;
	public $date;
	public $time;

	public function __construct($fileName) {
		$this->fileName = $fileName;
		$this->setDate($fileName);
	}

	private function setDate($fileName) {
		$explode = explode(".", $fileName);
		$dateString = $explode[0];
		$ex = explode("-", $dateString);
		$this->time = mktime(0, 0, 0, $ex[1], $ex[2], $ex[0]);
		$date = date('Y-m-d H:i:s', $this->time);
		$this->date = Html::dateToString($date);
	}

}

function getReferatFolders($folderPath) {
	$folders = getDirContents($folderPath);
	$referatFolders = array();
	foreach ($folders as $r) {
		$referatFolders[] = new ReferatFolder($folderPath . $r);
	}
	usort($referatFolders, "referatFolderComparator");
	return $referatFolders;
}

$folderPath = Yii::getPathOfAlias("webroot") . "/upc/files/styret/referater/";
$folderUrl = "/upc/files/styret/referater/";

$referatMapper = getReferatFolders($folderPath);
?>

<style>
	.mappe {
		overflow: auto;

	}
	.referat {
		float: left;
		width: 100px;
		height: 150px;
		margin: 1em;
		padding: 1em;
		background-color: #FDF;
		overflow: auto;
	}

	.referat img {
		display: block;
		width: 100px;
	}

	.referat a {
		color: #000;
		font-size: 18px;
		text-decoration: none;
	}
</style>


<? foreach ($referatMapper as $mappe): ?>
	<div class="mappe">
		<h2><?= $mappe->year . " " . $mappe->season ?></h2>

		<? foreach ($mappe->referater as $referat): ?>
			<div class="referat">
				<a href="<?= $folderUrl ?><?= $mappe->yearSeason ?>/<?= $referat->fileName ?>">
					<img src="/images/mastHeadLogo.png" />	
					<?= $referat->date ?>
				</a>
			</div>
		<? endforeach ?>
	</div>
<? endforeach ?>
