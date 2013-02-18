define(
		["canvasobject", "griffDrawer"],
		function(canvasobject, trigger) {


	var Victim = function(){
		this.parts = [];
		this.found = [];
		for (var i = 27; i >= 1; i--) {
			this.parts[i] = i;
		}
		this.image = new Image();
		this.image.src = "/images/griffgame/griff-1.png";

		this.drawNow = function(context) {
			context.drawImage(this.image, - this.image.width/2, - this.image.height/2);
			context.fillRect(-5,-5,5,5);
		};

		this.move = function() {
			this.x = Math.random() * 400;
			this.y = Math.random() * 300;
			this.changePart();
		};

		this.popRandom = function() {
			var i = this.parts.pop();
			this.found.push(i);
			return i;
		};

		this.changePart = function() {
			var i = this.popRandom();
			trigger(i);
			this.image.src = "/images/griffgame/griff-" + i + ".png";
		};

		this.move();
	};

	Victim.prototype = new canvasobject.CanvasObject();
	return Victim;
});