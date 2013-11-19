<link rel="stylesheet" type="text/css" href="css/blog.css">

<div class="warning">
	<!--<div id="pop" style="border-radius: 5px; font-size: 100%; text-align: center; position: absolute; width: 20px; height: 20px; color: #000; padding: 0px; font-weight: 900; top: 4px; right: 4px; background-color: #FFA600;">!</div>-->
	Vil du også skrive blogg-innlegg her? <?= CHtml::link("Logg deg inn!", user()->loginUrl) ?>
</div>

<script>
	window.onload=function() {
		window.blog_elements = document.getElementsByClassName("blog_entry");
		window.warning_elements = document.getElementsByClassName("warning");
		for (var i = 0; i<blog_elements.length; i++) {
			window.setTimeout(fade,i*100,false,blog_elements.item(i),1);
		}
		for (var j = 0; j<warning_elements.length; j++) {
			window.setTimeout(fade,j*100,true,warning_elements.item(j),1);
		}
	}

	function fade(sidescroll,obj,telle) {
		telle -= 0.05;
		obj.style.opacity = 1-telle*telle;
		if (sidescroll==false) {
			obj.style.top = telle*telle*25+"px";
		} else {
			obj.style.right = telle*telle*25+"px";
		}
		if (telle > 0) {
			window.setTimeout(fade,10,sidescroll,obj,telle);
		} else if (sidescroll==false) {
			obj.style.opacity = 1;
			obj.style.top = "0px";
		} else {
			obj.style.opacity = 1;
			obj.style.right = "0px";
		}
	}
</script>

<?php 
	for ($i = 0; $i < count($data); ++$i) {
		$row = $data[$i];
		echo "<div class=\"blog_entry\">";
		echo "<div class=\"title\">" . $row["title"] . "</div>";
		echo "<hr class=\"underline\" />";
		echo "<div class=\"content\">" . $row["content"] . "</div>";
		echo "<div class=\"dateline\"> Av " . $row["uid"] . ", " . $row["time"] . "</div>";
		echo "</div>";
	}
?>