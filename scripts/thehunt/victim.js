define(
		["canvasobject", "griffDrawer"],
		function(canvasobject, trigger) {


	var Victim = function(){
		this.parts = [];
		this.found = [];
		for (var i = 27; i >= 0; i--) {
			this.parts[i] = i;
		}
		this.image = new Image();
		this.image.src = "/images/griffgame/griff-0.png";
		this.image.oldIntValue = 0;

		this.drawNow = function(context) {
			context.drawImage(this.image, - this.image.width/2, - this.image.height/2);
		};

		this.move = function() {
			this.x = Math.random() * 400;
			this.y = Math.random() * 300;
		};

		this.popRandom = function() {
			if (this.parts.length === 0) {
				throw 20;
			}
			var i = this.parts.pop();
			this.found.push(i);
			return i;
		};

		this.hit = function() {
			trigger(this.image.oldIntValue);
			this.changePart();
			this.move();
		};

		this.changePart = function() {
			var i = this.popRandom();
			this.image.src = "/images/griffgame/griff-" + i + ".png";
			this.image.oldIntValue = i;
		};

		this.move();
	};

	Victim.prototype = new canvasobject.CanvasObject();
	return Victim;
});