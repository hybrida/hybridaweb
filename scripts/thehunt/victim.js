define(
		["canvasobject"],
		function(canvasobject) {


	var Victim = function(){
		this.drawNow = function(context) {
			context.fillRect(-5,-5,10,10);
		};

		this.move = function() {
			this.x = Math.random() * 400;
			this.y = Math.random() * 300;
		};

		this.move();
	};

	Victim.prototype = new canvasobject.CanvasObject();
	return Victim;
});