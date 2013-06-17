<div id="breadCrumb">
	<ul>
		<li><?= $this->firstCrumb ?></li>
    <?php
    foreach($this->links as $key => $value) {
		echo "<li>";
        if(!is_numeric($key)) {
            $title = $key;
            $url = $value;
            echo $this->link($title, $url);
        } else {
            $title = $value;
            echo $title;
        }
		echo "</li>\n";
    }
    ?>
	</ul>
</div>