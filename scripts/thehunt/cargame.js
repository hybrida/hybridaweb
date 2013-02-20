define(
		["car", "victim"],
		function(Car, Victim) {

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
		var self = this;

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
		this.time = 0.0;
		this.fps = 40;

		this.addCar = function(car) {
			car.normalizeToFPS(this.fps);
			this.carList.push(car);
		};

		this.timetick = function() {
			this.time = Date.now() - this.firstFrame;
			this.printTime();
		};

		this.printTime = function() {
			var ctx = self.context;
			ctx.save();
			ctx.globalAlpha = 0.1;
			ctx.font = "50pt Arial";
			var timeInSeconds = this.time / 1000;
			timeInSeconds = Math.round(timeInSeconds * 10) / 10;
			var txt = "" + timeInSeconds;
			if (timeInSeconds % 1 === 0) {
				txt += ".0";
			}
			ctx.fillText(txt,550,100);
			ctx.restore();
		};

		this.run = function() {
			self.context.clearRect(0,0,width,height);
			self.timetick();
			self.victim.draw(self.context);
			for (var i = 0; i < self.carList.length; i++) {
				self.runCar(self.carList[i]);
			}
		};

		this.runCar = function(car) {
			car.move();
			if (car.distance(self.victim) < 30) {
				try {
					self.victim.hit();
					car.addPoint();
				} catch(e) {
					self.gameOver();
				}
			}
			self.moveCarInsideCanvas(car);
			car.draw(self.context);
		};

		this.gameOver = function() {
			this.stop();
			this.finalTime = this.time;
			this.drawFinalTime();
			$.ajax({
				success: function(html){
					data.highscorelist.innerHTML = html;
				},
				type: 'get',
				url: "/game/score",
				data: {
					time: this.finalTime.toFixed(5)
				},
				cache: false,
				dataType: 'html'
			});
		};

		this.drawFinalTime = function() {
			var ctx = this.context;
			ctx.save();
			ctx.font = "bold 80px Arial";
			ctx.fillText("Score: " + this.finalTime/1000, 50,350);
			ctx.restore();
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
			this.frameSpeed = 1000/this.fps;
			this.timer = setInterval(this.run, this.frameSpeed);
			this.firstFrame = Date.now();
		};

		this.stop = function() {
			clearInterval(self.timer);
		};
	}

	return {
		Car: Car,
		CarGame: CarGame
	};

});