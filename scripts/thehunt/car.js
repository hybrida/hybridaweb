define(["canvasobject", "keylistener", "fastmath"],
		function(canvasobject, keylistener, fastmath){

	function randomColor() {
		var red = Math.floor(Math.random() * 255);
		var green = Math.floor(Math.random() * 255);
		var blue = Math.floor(Math.random() * 255);
		return "rgba(" + red + "," + green +","+ blue + ",1)";
	}

	function Car () {
		this.image = new Image();
		this.image.src =  "/images/griffgame/car1.png";
		this.rotationSpeed = 0.015;
		this.acceleration = 0.1;
		this.maxSpeed = 6;
		this.size = 20;
		this.points = 0;
		this.keys = {
			up: 38,
			left: 37,
			right: 39,
			down: 40,
			changeColor: 48
		};
		this.speed = 0;

		this.isDown = function(direction) {
			return keylistener.isDown(
				this.keys[direction]);
		};

		this.move = function() {
			this.setVelocity();
		};

		this.setVelocity = function() {
			var up = this.isDown("up");
			var down = this.isDown("down");
			var left = this.isDown("left");
			var right = this.isDown("right");
			var acc = this.acceleration;
			var maxSpeed = this.maxSpeed;

			if (up && this.speed < maxSpeed) {
				this.speed += acc;
			} else if(down && this.speed > -maxSpeed) {
				this.speed -= acc;
			} else if (this.speed >= acc) {
				this.speed -= (this.speed > 0 ? 1 : -1) * acc;
			} else {
				this.speed = 0;
			}

			if (left) {
				this.rotation -= this.speed * this.rotationSpeed;
			} else if (right) {
				this.rotation += this.speed * this.rotationSpeed;
			}
			if (this.rotation >= 2 * Math.PI) this.rotation -= 2 * Math.PI;
			if (this.rotation < 0) this.rotation += 2* Math.PI;

			this.x += this.speed * fastmath.cos(this.rotation);
			this.y += this.speed * fastmath.sin(this.rotation);
		};
		var self = this;
		this.drawNow = function(context) {
			context.drawImage(self.image, - self.image.width/2, - self.image.height/2);
		};

		this.addPoint = function() {
			this.points++;
		};

	}

	Car.prototype = new canvasobject.CanvasObject();
	return Car;
});