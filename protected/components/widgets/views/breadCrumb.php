<div id="breadCrumb">
	<ul>
		<li><?= $this->firstCrumb ?></li>
    <?php
    foreach($this->links as $val => $url) {
		echo "<li>";
        if(isset($url)) {
            echo $this->link($val, $url);
        } else {
            echo $val;
        }
		echo "</li>\n";
    }
    ?>
	</ul>
</div>