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
		if (key.keyCode === 116) {
			location.reload(true);
		}
		key.preventDefault();
		return false;
	}

	function onKeyUp (key) {
		down[key.keyCode] = false;
	}

	window.addEventListener("keydown", onKeyDown, false);
	window.addEventListener("keyup", onKeyUp, false);

	return {
		isDown: isDown
	};

});