define(
		["keylistener", "canvasobject", "fastmath", "car", "victim"],
		function(keylistener, canvasobject, fastmath, Car, Victim) {

	var width = 800;
	var height = 400;
	var fps;
	var canvas;
	var game;

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
		this.pictures = [];
		this.found = [];
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

	return {
		Car: Car,
		CarGame: CarGame
	};

});