<div class="view">
<?
        $c = 0;
	foreach($model['image'] as $i)
	{
                if ($c == 3)
                {
                    $c = 0;
                    echo "<br>";
                }
                else
                {
                    echo " ";
                    $c++;
                }
                $url = "/images/" . $i['oldName'];
                $img = CHtml::image($url, $i['title'], array('width' => '200'));
                
		echo CHtml::link($img, array('image/view', 'id' => $i['id'])); 
	}
?>
</div>
