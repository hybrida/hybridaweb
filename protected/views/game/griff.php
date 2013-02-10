<? $this->addJavascript("thehunt/run") ?>

<div class="newsThehunt">
	<h1>The Hunt</h1>

	<canvas id="thehunt" width="700" height="400"></canvas>
</div>

<style>
	canvas {
		border: 1px solid white;
		margin: auto;
		width: 700px;
		height: 400px;
		background-color: #ccf;
		border-radius: 2px;
	}
</style>

<script>
	var data = {
		canvas: document.getElementById("thehunt"),
	};
</script>