require(['cargame'], function(cargame) {
	var game = new cargame.CarGame(data.canvas);
	var car = new cargame.Car();
	game.addCar(car);
	game.start();
});