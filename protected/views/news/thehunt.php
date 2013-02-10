<? $this->addJavascript("thehunt/run") ?>

<div class="newsThehunt">
	<h1>The Hunt</h1>
</div>

<canvas id="thehunt" width="700" height="400"></canvas>

<style>
	canvas {
		border: 1px solid white;
		margin: auto;
		width: 700px;
		height: 400px;
		background-color: #fcf;
		border-radius: 2px;
	}
</style>

<script>
	var data = {
		canvas: document.getElementById("thehunt"),
	};
</script>

<script2>
<!--
	define( function() {

	var log = function (msg, level) {
		if (level === undefined) {
			level = "glob";
		}
		console.log(level + ": " +msg);
	};

	var wrapper = document.getElementById("wrapper");

	function placeCanvas(canvas) {
		canvas.style.border = "1px solid #FFFFF";
		var style = wrapper.style;
		style.margin = "auto";
		style.width = canvas.width + "px";
		style.backgroundColor = "gray";
		style.borderRadius = "2px";
		wrapper.appendChild(canvas);
		document.body.appendChild(wrapper);
	}

	function placeOnWrapper(element) {
		wrapper.appendChild(element);
	}

	return {
		log: log,
		placeCanvas: placeCanvas,
		placeOnWrapper: placeOnWrapper
	};
});
	-->
</script2>