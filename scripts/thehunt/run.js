require(['cargame'], function(cargame) {

	var canvas = data.canvas;
	var startButton = data.startButton;
	var tutorial = data.tutorial;
	var highscorelist = data.highscorelist;
	var gameWrap = data.gameWrap;
	var restartButton = data.restartButton;

	var run = function() {
		var game = new cargame.CarGame(data.canvas);
		var car = new cargame.Car();
		game.addCar(car);
		game.start();
	};

	startButton.addEventListener('click', function(){
		tutorial.style.display = "none";
		gameWrap.style.display = "block";
		run();
	});

	restartButton.addEventListener('click', function() {
		location.reload(true);
	});


});