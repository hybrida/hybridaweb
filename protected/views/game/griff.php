<?php

$this->addJavascript("thehunt/run");
$this->layout = "//layouts/doubleColumn";

 ?>

<div class="newsThehunt">
	<h1>The Hunt</h1>
	<div id="gameWrap" style="display:none">
		<canvas id="thehunt" width="700" height="400"></canvas>
		<div class="buttonContainer">
			<input type="button" id="restartButton" class="g-button" value="Restart" />
		</div>
	</div>

	<div id="tutorial">
		<img src="/images/griffgame/start.png" alt="" />
		<br>

		<div class="buttonContainer">
			<input id="thebutton" type="button" class="g-button" value="Start spillet nå!" />
		</div>
	</div>
</div>

<style>
	canvas#thehunt {
		border: 2px solid #888;
		margin: auto;
		width: 700px;
		height: 400px;
		background-color: #eee;
		border-radius: 2px;
	}

	.newsThehunt input[type=button] {
		margin: auto;
		display: block;
	}

	#tutorial img {
		margin: auto;
		display: block;
	}

	#thehunt_picture {
		margin-top: 50px;
		margin-left: 10px;
		display: block;
	}

	.userScore .score {
		width: 5em;
		font-weight: bold;
	}


</style>

<script>
	var data;
	document.ready = function() {
		data = {
			canvas: document.getElementById("thehunt"),
			pictureCanvas: document.getElementById("thehunt_picture"),
			startButton: document.getElementById("thebutton"),
			tutorial: document.getElementById("tutorial"),
			highscorelist: document.getElementById("highscorelist"),
			gameWrap: document.getElementById("gameWrap"),
			restartButton: document.getElementById("restartButton")
		};
	}
</script>

<? $this->beginClip("sidebar") ?>

<div class="g-barTitle">Progresjon</div>
<canvas id="thehunt_picture" width="230" height="216"></canvas>

<div id="highscorelist">
	<? $this->renderPartial('_highscore', array(
		'highscorelist' => $highscorelist,
	))  ?>
</div>
<? $this->endClip() ?>