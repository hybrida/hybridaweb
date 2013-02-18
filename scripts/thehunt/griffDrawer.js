define([],function(){

	var canvas = data.pictureCanvas;
	var context = canvas.getContext("2d");
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

	function randomColor() {
		var red = Math.floor(Math.random() * 255);
		var green = Math.floor(Math.random() * 255);
		var blue = Math.floor(Math.random() * 255);
		return "rgba(" + red + "," + green +","+ blue + ",1)";
	}

	var trigger = function(i){
		// Her skal drawPart være
	};

	var drawPart = function(i) {
		var image = new Image();
		image.src = "/images/griffgame/griff-" + i + ".png";
		image.onload = function() {
			var x = coords[i][0];
			var y = coords[i][1];
			console.log("griffDrawer: " + i, x, y);
			context.beginPath();
			context.strokeStyle = randomColor();
			context.rect(x,y,image.width, image.height);
			context.stroke();
			context.drawImage(image, x, y);
			context.strokeText("" + i, x+image.width/2, y+image.height/2);
		};
	};

	for (var i = 1; i <=27; i++) {
		drawPart(i);
	}


	return trigger;
});