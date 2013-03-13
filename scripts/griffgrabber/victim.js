define(
		["griffgrabber/canvasobject", "griffgrabber/griffDrawer"],
		function(canvasobject, griffDrawer) {


	var Victim = function(){
		this.parts = [];
		this.found = [];
		for (var i = 27; i >= 1; i--) {
			this.parts[i] = i;
		}
		this.image = new Image();
		this.image.src = "/images/griffgame/griff-0.png";
		this.image.oldIntValue = 0;

		this.drawNow = function(context) {
			context.drawImage(this.image, - this.image.width/2, - this.image.height/2);
		};

		this.move = function() {
			this.x = 10 + Math.random() * 680;
			this.y = 10 + Math.random() * 380;
		};

		this.popRandom = function() {
			var i = this.parts.pop();
			this.found.push(i);
			if (this.parts.length === 0) {
				throw 20;
			}
			return i;
		};

		this.hit = function() {
			griffDrawer.trigger(this.image.oldIntValue);
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