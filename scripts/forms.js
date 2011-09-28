function toggleEvent(){
	if(document.getElementsByName('isEvent').item(0).checked == true)
	{
		document.getElementById('event_div').style.display = 'block';
	}
	else
	{
		document.getElementById('event_div').style.display = 'none';
		document.getElementById('signup_div').style.display = 'none';
		document.getElementsByName('isSignup').item(0).checked =false;
	}
}

function toggleSignup(){
	if(document.getElementsByName('isSignup').item(0).checked == true &&
		document.getElementsByName('isEvent').item(0).checked == true)
		{
		document.getElementById('signup_div').style.display = 'block';
	}
	else
	{
		document.getElementById('signup_div').style.display = 'none';
		document.getElementsByName('isSignup').item(0).checked =false;
	}
}
//
//function toggleNews() {
//	var elm = document.getElementById("newsForm_div");
//	if (elm.style.display == 'none') {
//		elm.style.display = "block";
//	} else {
//		elm.style.display = "none";
//	}
//}

function toggleNews(){
	var div = document.getElementById("newsForm_div");
	var box = document.getElementsByName('isNews').item(0);
	
	if (box.checked) {
		div.style.display = "block";
	} else if (box.checked == false){
		div.style.display = 'none';
	}
	

}
