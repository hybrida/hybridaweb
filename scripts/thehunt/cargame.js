define(["keylistener", "canvasobject", "fastmath"], function(keylistener, canvasobject, fastmath){

	var width = 800;
	var height = 400;
	var fps;
	var canvas;
	var game;

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
			if (this.isDown("changeColor")) {
				this.bodyColor = randomColor();
				this.wheelColor = randomColor();
			}
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

	var Victim = function(){
		this.drawNow = function(context) {
			context.fillRect(-5,-5,10,10);
		};

		this.move = function() {
			this.x = Math.random() * width;
			this.y = Math.random() * height;
		};

		this.move();
	};

	Victim.prototype = new canvasobject.CanvasObject();

	var scores = document.createElement("div");
	var score1 = document.createElement("span");
	var score2 = document.createElement("span");
	scores.appendChild(score1);
	scores.appendChild(score2);
	setStyle(score1);
	setStyle(score2);
	score2.style.float = "right";

	function setStyle(score){
		var s = score.style;
		s.border = "1px solid #000000";
		s.margin = "2px";
		s.padding = "0 20px 0 20px";
		s.display = "block";
		s.float = "left";
		s.fontSize = "25px";
		s.color = "#FFFFFFF";
		s.borderRadius = "2px";

	}

	function CarGame(canvas) {
		this.timer = null;
		this.numberOfSecondsInCountdown = 30;
		this.countdown = this.numberOfSecondsInCountdown;

		this.canvas = canvas;
		this.context = canvas.getContext("2d");
		this.width = canvas.width;
		this.height = canvas.height;
		this.victim = new Victim();
		this.carList = [];

		this.addCar = function(car) {
			this.carList.push(car);
		};

		var self = this;
		this.run = function() {
			self.context.clearRect(0,0,width,height);
			self.victim.draw(self.context);
			for (var i = 0; i < self.carList.length; i++) {
				var car = self.carList[i];
				car.move();
				if (car.distance(self.victim) < 30) {
					self.victim.move();
					car.addPoint();
				}
				self.moveCarInsideCanvas(car);
				car.draw(self.context);
				}
		};

		this.moveCarInsideCanvas = function(car) {
			var w = 10;
			if (car.x < -w) {
				car.x = self.width+w;
			} else if (car.x > self.width+w) {
				car.x = -w;
			}

			if (car.y < 0-w) {
				car.y = self.height+w;
			} else if (car.y > self.height+w) {
				car.y = 0-w;
			}
		};

		this.start = function() {
			this.timer = setInterval(this.run, 1000/50);
		};
	}

	function cargame() {
		fps = 60;
		canvas = document.createElement("canvas");
		canvas.width = width;
		canvas.height = height;
		core.placeCanvas(canvas);
		game = new CarGame(canvas);
		var car = new Car();
		var car2 = new Car();
		car2.keys = {
			up: 87,
			down: 83,
			left: 65,
			right: 68,
			changeColor: 32
		};
		game.addCar(car);
		game.addCar(car2);
		game.start();
		core.placeOnWrapper(scores);
	}

	function startGame() {
		core.log("Game ON!!", "cargame");
		cargame();
	}

	return {
		Car: Car,
		CarGame: CarGame,
		startGame: startGame
	};

});