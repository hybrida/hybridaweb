define(function(){

	var down = {};

	function isDown (keyCode) {
		if (down[keyCode] !== undefined) {
			return down[keyCode];
		}
		return false;
	}

	function onKeyDown (key) {
		down[key.keyCode] = true;
		key.preventDefault();
		return false;
	}

	function onKeyUp (key) {
		down[key.keyCode] = false;
		key.preventDefault();
		return false;
	}

	window.addEventListener("keydown", onKeyDown, false);
	window.addEventListener("keyup", onKeyUp, false);

	return {
		isDown: isDown
	};

});