require(['cargame'], function(cargame) {

	var canvas = data.canvas;
	var button = data.button;
	var tutorial = data.tutorial;



	var run = function() {
		var game = new cargame.CarGame(data.canvas);
		var car = new cargame.Car();
		game.addCar(car);
		game.start();
	};

	canvas.style.display = "none";

	button.addEventListener('click', function(){
		tutorial.style.display = "none";
		canvas.style.display = "block";
		run();
	});


});