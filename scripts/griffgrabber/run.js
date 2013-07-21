define(['griffgrabber/cargame'], function(cargame) {

	var canvas;
	var startButton;
	var tutorial;
	var highscorelist;
	var gameWrap;
	var restartButton;
	var pictureCanvas;

	var game;

	var run = function() {
		game = new cargame.CarGame(canvas);
		var car = new cargame.Car();
		game.addCar(car);
		game.startWithCountDown();
	};

	var init = function(data){
		canvas = data.canvas;
		startButton = data.startButton;
		tutorial = data.tutorial;
		highscorelist = data.highscorelist;
		gameWrap = data.gameWrap;
		restartButton = data.restartButton;
		pictureCanvas = data.pictureCanvas;

		cargame.init({
			pictureCanvas: pictureCanvas,
			highscorelist: highscorelist
		});

		game = new cargame.CarGame(data.canvas);

		startButton.addEventListener('click', function(){
			tutorial.style.display = "none";
			gameWrap.style.display = "block";
			run();
		});

		restartButton.addEventListener('click', function() {
			game.restart();
		});
	};

	return {
		'init': init
	};


});