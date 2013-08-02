<?php

function getDirContents($folderPath) {
	$dirHandle = opendir($folderPath);
	$file = readdir($dirHandle);
	$files = array();
	while ($file) {
		if ($file != "." && $file != ".." && $file != ".hg" && $file != ".hgignore") {
			$files[] = $file;
		}
		$file = readdir($dirHandle);
	}
	return $files;
}

function getPdfFilesInDirectory($folderPath) {
	$files = getDirContents($folderPath);
	$pdfs = array();
	foreach ($files as $file) {
		$explode = explode(".", $file);
		if ($explode[1] == "pdf") {
			$pdfs[] = $file;
		}
	}
	return $pdfs;
}

function getUtgaveFolders($folderPath) {
	$folders = getDirContents($folderPath);
	$utgaveFolders = array();
	foreach ($folders as $r) {
		$utgaveFolders[] = new UtgaveFolder($folderPath . $r);
	}
	usort($utgaveFolders, "utgaveFolderComparator");
	return $utgaveFolders;
}

function utgaveFolderComparator($folder1, $folder2) {
	$yearDiff = $folder2->year2 - $folder1->year2;
	return $yearDiff;
}

function utgaveComparator($ref1, $ref2) {
	return $ref1->nummer - $ref2->nummer;
}

class UtgaveFolder {

	public $utgaver;
	public $year;
	public $schoolYear;
	public $path;

	public function __construct($path) {
		$this->path = $path;
		$this->setSchoolYear($path);
		$this->setUtgaver($path);
		$this->sortUtgaver();
	}

	private function setSchoolYear($path) {
		$date = explode("/", $path);
		$this->year1 = substr($date[count($date) - 1], 0, 4);
		$this->year2 = substr($date[count($date) - 1], 5, 4);
		$this->schoolYear = $this->year1 . "/" . $this->year2;
	}

	private function setUtgaver($path) {
		$utgaver = getPdfFilesInDirectory($path);
		foreach ($utgaver as $utg) {
			$this->utgaver[] = new Utgave($utg);
		}
	}

	private function sortUtgaver() {
		usort($this->utgaver, "utgaveComparator");
	}
}

class Utgave {

	public $fileName;
	public $pictureFileName;
	public $nummer;
	public $sommer;

	public function __construct($fileName) {
		$this->fileName = $fileName;
		$explode = explode(".", $fileName);
		$this->pictureFileName = $explode[0] . ".png";
		$explode2 = explode("-", $explode[0]);
		$this->nummer = $explode2[1] == "00" ? $this->nummer = "Sommer" : $this->nummer = $explode2[1];

	}
}


$folderUrl = "/upc/files/updatek/";
$folderPath = Yii::getPathOfAlias("webroot") . $folderUrl;

$utgaveMapper = getUtgaveFolders($folderPath);
?>

<style>
	.mappe {
		overflow: auto;

	}
	.utgave a {
		width: 200px;
		float: left;
		padding: 0.5em;
		margin: 0.3em;
		background-color: #eee;
		overflow: auto;
		border-radius: 2px;

	}

	.utgave a img {
		width: 200px;
		height: 283px;
		position: relative;
		top: 2px;
	}

	.utgave a {
		color: #000;
		font-size: 18px;
		font-weight: bold;
		text-align: center;
		text-decoration: none;
	}

	.utgave a:hover {
		background-color: #D9D9D9;
	}
</style>

<div id="article-title">
	<h1><?= $article->title?></h1>
</div>

<div id="article-content">

	<div>
		<?= $article->content ?>
	</div>

	<? foreach ($utgaveMapper as $mappe): ?>
		<div class="mappe">
			<h2><?= "Skoleåret " . $mappe->schoolYear ?></h2>

			<? foreach ($mappe->utgaver as $utgave): ?>
				<div class="utgave">
					<a href="<?= $folderUrl ?><?= $mappe->year1 . "-" . $mappe->year2 ?>/<?= $utgave->fileName ?>">
						<img src="<?= $folderUrl ?><?= $mappe->year1 . "-" . $mappe->year2 ?>/<?= $utgave->pictureFileName ?>" />
						<?= $utgave->nummer ?>
					</a>
				</div>
			<? endforeach ?>
		</div>
	<? endforeach ?>
</div>