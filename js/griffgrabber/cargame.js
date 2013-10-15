define(
		["griffgrabber/car", "griffgrabber/victim", "griffgrabber/griffDrawer"],
		function(Car, Victim, griffDrawer) {

	var width = 800;
	var height = 400;
	var fps;
	var canvas;
	var game;
	var highscorelist;

	var init = function(data) {
		var pictureCanvas = data.pictureCanvas;
		highscorelist = data.highscorelist;
		griffDrawer.init({
			pictureCanvas: pictureCanvas
		});
	};

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
		this.fps = 60;


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
					highscorelist.innerHTML = html;
				},
				type: 'post',
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
			this.victim = new Victim();
			griffDrawer.clear();
		};


		this.stop = function() {
			clearInterval(self.timer);
			for (var i = 0; i < this.carList.length; i++) {
				var car = this.carList[i];
				car.speed = 0;
			}
		};

		this.startWithCountDown = function() {
			this.countDownCount = 3;
			this.countDownTimer = setInterval(this.countDownTick, 1000);
			this.countDownTick();
		};

		this.restart = function() {
			this.stop();
			this.startWithCountDown();
		};

		this.countDownTick = function() {
			if (self.countDownCount <= 0) {
				clearInterval(self.countDownTimer);
				self.start();
			}
			self.context.save();
			self.context.font = "italic 80px Calibri";
			self.context.fillText("" + self.countDownCount, 300 - self.countDownCount*70, 200);
			self.context.restore();
			self.countDownCount -= 1;
		};
	}

	return {
		init: init,
		Car: Car,
		CarGame: CarGame
	};

});