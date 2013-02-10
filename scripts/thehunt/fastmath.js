define(function(){
	var fac = function(x) {
		if (x == 0) return 1;
		return x * fac(x-1);
	}

	console.log(fac(3));
	console.log(fac(5));

	var sin = function(x) {
		return x - (x ^ 3) / fac(3) + (x ^ 5) / fac(5) - x ^ 7 / fac(7);
	};

	var cos = function(x) {
		return 1 - (x ^ 2) / fac(2) + (x ^ 4) / fac(4) - x ^ 6 / fac(6);
	}

	for (var i = 0; i < 2*Math.PI;i += Math.PI/4) {
		console.log(i, cos(i), sin(i));
	}

	return {
		cos: Math.cos,
		sin: Math.sin
	}
});