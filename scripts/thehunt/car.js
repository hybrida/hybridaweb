define(["canvasobject", "keylistener", "fastmath"],
		function(canvasobject, keylistener, fastmath){

	function randomColor() {
		var red = Math.floor(Math.random() * 255);
		var green = Math.floor(Math.random() * 255);
		var blue = Math.floor(Math.random() * 255);
		return "rgba(" + red + "," + green +","+ blue + ",1)";
	}

	function Car () {
		var self = this;
		this.image = new Image();
		this.image.src =  "/images/griffgame/car1.png";
		this.rotationSpeed = 0.018;
		this.acceleration = 0.4;
		this.maxSpeed = 12;
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

		this.move = function(timeFactor) {
			this.timeFactor = timeFactor;
			this.setVelocity();
		};

		this.setVelocity = function() {
			this.up = this.isDown("up");
			this.down = this.isDown("down");
			this.left = this.isDown("left");
			this.right = this.isDown("right");

			this.setSpeed();
			this.setRotation();

			this.x += this.speed * fastmath.cos(this.rotation)*this.timeFactor;
			this.y += this.speed * fastmath.sin(this.rotation)*this.timeFactor;
		};

		this.setSpeed = function() {
			var maxSpeed = this.maxSpeed;
			var acc = this.acceleration;
			if (this.up && this.speed < maxSpeed) {
				this.speed += acc;
			} else if(this.down && this.speed > -maxSpeed) {
				this.speed -= acc;
			} else if (Math.abs(this.speed) >= acc) {
				this.speed -= (this.speed > 0 ? 1 : -1) * acc;
			} else {
				this.speed = 0;
			}
		};

		this.setRotation = function() {
			if (this.left) {
				this.rotation -= this.speed * this.rotationSpeed;
			} else if (this.right) {
				this.rotation += this.speed * this.rotationSpeed;
			}
			if (this.rotation >= 2 * Math.PI) this.rotation -= 2 * Math.PI;
			if (this.rotation < 0) this.rotation += 2* Math.PI;
		};

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