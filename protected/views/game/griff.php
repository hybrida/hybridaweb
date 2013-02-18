<?php

$this->addJavascript("thehunt/run");
$this->layout = "//layouts/doubleColumn";

 ?>

<div class="newsThehunt">
	<h1>The Hunt</h1>

	<canvas id="thehunt" width="700" height="400"></canvas>
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
</style>

<script>
	var data;
	document.ready = function() {
		data = {
			canvas: document.getElementById("thehunt"),
			pictureCanvas: document.getElementById("thehunt_picture")
		};
}
</script>

<canvas id="thehunt_picture" width="530" height="316"></canvas>
<? $this->beginClip("sidebar") ?>


<? $this->endClip() ?>