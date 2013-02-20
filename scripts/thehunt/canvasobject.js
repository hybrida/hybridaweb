define(function() {

	function CanvasObject(context) {
		this.context = context;
		this.x = 0;
		this.y = 0;
		this.rotation = 0;
		this.scale = 1;

		this.draw = function(context) {
			context.save();
			context.translate(this.x,this.y);
			context.rotate(this.rotation);
			context.scale(this.scale, this.scale);
			this.drawNow(context);
			context.restore();
		};

		this.drawNow = function(context) {
			throw "Not Implemented Yet";
		};

		this.distance = function(canvasObject) {
			var dx = canvasObject.x - this.x;
			var dy = canvasObject.y - this.y;
			return Math.sqrt(dx * dx + dy * dy);
		};
	}
	return {
		CanvasObject: CanvasObject
	};
});
