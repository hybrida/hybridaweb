<div id="breadCrumb">
	<ul>
		<? if ($this->option("firstCrumb")): ?>
			<li><?= $this->firstCrumb ?></li>
		<? endif ?>
    <?php
    foreach($this->links as $val => $url) {
		echo "<li>";
        if(isset($url)) {
            echo CHtml::link($val, $url);
        } else {
            echo $val;
        }
		echo "</li>\n";
    }
    ?>
	</ul>
</div>