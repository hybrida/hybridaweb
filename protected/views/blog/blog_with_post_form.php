<?php echo CHtml::beginForm(); ?>
 
    <div class="row">
        <?php echo CHtml::activeLabel($formdata, "Tittel"); ?>
        <?php echo CHtml::activeTextField($formdata, "title") ?>
    </div>
 
    <div class="row">
        <?php echo CHtml::activeTextField($formdata, "content", array("width" => 800, "height" => 600)) ?>
    </div>
    <?php echo CHtml::submitButton("La verden høre meg!"); ?>
<?php echo CHtml::endForm(); ?>

<?php	
	for ($i = 0; $i < count($data); ++$i) {
		$row = $data[$i];
		echo "<h1>" . $row["title"] . "</h1>";
		echo "<p>" . $row["content"] . "</p>";
		echo "<p> Av " . $row["uid"] . ", " . $row["time"] . "</p>";
	}
?>
