define([],function(){

	var canvas;
	var context;
	var coords = [
		[34, 43],
		[15, 87],
		[39.5 ,102],
		[66 ,73],
		[47 ,140.5],
		[52.5 ,169.5 ],
		[51, 191.5],
		[73.5, 104 ],
		[86, 134.5],
		[82, 151.5],
		[83, 170],
		[101, 190.5],
		[98.5, 85.5],
		[120.5, 26],
		[135.5, 62],
		[133, 87.5],
		[134, 112],
		[127, 148.5],
		[149, 181.5],
		[200.5, 59.5],
		[203.5, 89.5],
		[167.5, 69.5],
		[172, 94.5],
		[174.5, 116],
		[170, 139],
		[166, 163.5],
		[187.5, 184],
		[162, 203]
	];

	var init = function(data) {
		canvas = data.pictureCanvas;
		context = canvas.getContext("2d");
		drawBackground();
	};

	var drawBackground = function () {
		var img = new Image();
		img.src = "/images/griffgame/griff-faded.png";
		img.onload = function(){
			context.save();
			context.globalAlpha = 0.3;
			context.drawImage(img,0,0);
			context.restore();
		};
	};

	function randomColor() {
		var red = Math.floor(Math.random() * 255);
		var green = Math.floor(Math.random() * 255);
		var blue = Math.floor(Math.random() * 255);
		return "rgba(" + red + "," + green +","+ blue + ",1)";
	}

	var trigger = function(i){
		drawPart(i);
	};

	var drawPart = function(i) {
		var image = new Image();
		image.src = "/images/griffgame/griff-" + i + ".png";
		image.onload = function() {
			var x = coords[i][0];
			var y = coords[i][1];
			context.drawImage(image, x-image.width/2, y - image.height/2);
		};
	};

	var clear = function() {
		context.clearRect(0,0, canvas.width, canvas.height);
		drawBackground();
	};

	return {
		init: init,
		trigger: trigger,
		clear: clear
	};
});