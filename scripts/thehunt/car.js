define(["canvasobject", "keylistener", "fastmath"],
		function(canvasobject, keylistener, fastmath){

	function randomColor() {
		var red = Math.floor(Math.random() * 255);
		var green = Math.floor(Math.random() * 255);
		var blue = Math.floor(Math.random() * 255);
		return "rgba(" + red + "," + green +","+ blue + ",1)";
	}

	function Car () {
		this.bodyColor = randomColor();
		this.wheelColor = randomColor();
		this.rotationSpeed = 0.015;
		this.acceleration = 0.5;
		this.maxSpeed = 10;
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

			if (!down && this.speed < maxSpeed) {
				this.speed += acc;
			} else if(down && this.speed > -maxSpeed) {
				this.speed -= acc;
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

		this.drawNow = function(context) {
			var px = 5;

			context.fillStyle = this.wheelColor;

			// Upper left wheel
			context.strokeRect(-3*px, -4*px, 3*px, 2*px);
			context.fillRect(  -3*px, -4*px, 3*px, 2*px);

			// Upper right wheel
			context.strokeRect(3*px, -4*px, 2*px, 2*px);
			context.fillRect(  3*px, -4*px, 2*px, 2*px);

			//lower left wheel
			context.strokeRect(-3*px, 2*px, 3*px, 2*px);
			context.fillRect(  -3*px, 2*px, 3*px, 2*px);

			//lower right wheel
			context.strokeRect(3*px, 2*px, 2*px, 2*px);
			context.fillRect(  3*px, 2*px, 2*px, 2*px);

			// body
			context.fillStyle = this.bodyColor;
			context.fillRect(-4*px,-3*px,11*px, 6*px);
			context.strokeRect(-4*px, -3*px, 11*px, 6*px);
		};

		this.addPoint = function() {
			this.points++;
			this.maxSpeed += (Math.random() > 0.5) ? 1 : -1;
			
		};

	}

	Car.prototype = new canvasobject.CanvasObject();
	return Car;
});