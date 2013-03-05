define(function(){
	var fac = function(x) {
		if (x === 0) return 1;
		return x * fac(x-1);
	};

	var k = function (x,n) {
		return (x ^ n) / fac(n);
	};

	var sin = function(x) {
		x -= Math.PI;
		return - x + (x^3)/6 - (x^5)/120 + (x^7)/5040 - (x^9)/362880;
	};

	var cos = function(x) {
		x -= Math.PI;
		return - 1 + (x^2)/2 - (x^4)/24  + (x^6)/720  - (x^8)/40320;
	};

	for (var i = 0; i <= 2*Math.PI;i += Math.PI/4) {
		// console.log(i, cos(i), sin(i));
	}

	return {
		cos: Math.cos,
		sin: Math.sin
	};
});