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
		this.slideRotation = null;
		this.slideTurn = null;
		this.acceleration = 0.1;
		this.maxSpeed = 6;
		this.slidePath = [];
		this.size = 20;
		this.points = 0;
		this.keys = {
			up: 38,
			left: 37,
			right: 39,
			down: 40,
			changeColor: 48,
			slide: 32,
			clear: 27
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
			var slide = this.isDown("slide");

			if (this.isDown("clear")) {
				this.slidePath = [];
			}

			if (slide && this.slideRotation === null) {
				this.slideRotation = this.rotation;
				if (left) {
					this.slideTurn = "left";
				} else if (right) {
					this.slideTurn = "right";
				}
				// this.slidePath = [];
			}
			if (!slide) {
				this.slideRotation = null;
				this.slideTurn = null;
				// this.slidePath = [];
			}

			var acc = this.acceleration;
			var maxSpeed = this.maxSpeed;



			if (this.slideRotation !== null) {
				// Bilen sklir
				this.slidePath.push({x: this.x, y:this.y});
				if (Math.abs(this.speed) >= acc) {
					this.speed -= (this.speed > 0 ? 1 : -1) * acc;
				} else {
					this.speed = 0;
				}

				if (this.slideTurn === "left") {
					this.rotation -= this.speed * this.rotationSpeed/2;
					this.slideRotation -= this.speed * this.rotationSpeed/3;
				} else if (this.slideTurn === "right") {
					this.rotation += this.speed * this.rotationSpeed/2;
					this.slideRotation += this.speed * this.rotationSpeed/3;
				}

				this.x += this.speed * fastmath.cos(this.slideRotation);
				this.y += this.speed * fastmath.sin(this.slideRotation);
			} else {
				if (up && this.speed < maxSpeed) {
					this.speed += acc;
				} else if(down && this.speed > -maxSpeed) {
					this.speed -= acc;
				} else if (Math.abs(this.speed) >= acc) {
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
			}
		};
		var self = this;
		this.drawNow = function(context) {
			context.drawImage(self.image, - self.image.width/2, - self.image.height/2);
		};

		this.rawDraw = function(ctx) {
			if (self.slidePath.length === 0) {
				return;
			}
			ctx.save();
			ctx.beginPath();
			ctx.lineWidth = 20;
			ctx.lineCap = "round";
			ctx.globalAlpha = 0.3;
			//ctx.strokeStyle = "#888";
			var start = self.slidePath[0];
			var past = start;
			ctx.moveTo(start.x, start.y);
			for (var i = 0; i < self.slidePath.length; i++) {
				var next = self.slidePath[i];
				if (Math.abs(next.x - past.x) > 50 || Math.abs(next.y - past.y) > 50) {
					ctx.moveTo(next.x, next.y);
					past = next;
					continue;
				}
				ctx.lineTo(next.x, next.y);
				past = next;
			}
			ctx.stroke();
			ctx.closePath();
			ctx.restore();
		};

		this.addPoint = function() {
			this.points++;
		};

	}

	Car.prototype = new canvasobject.CanvasObject();
	return Car;
});