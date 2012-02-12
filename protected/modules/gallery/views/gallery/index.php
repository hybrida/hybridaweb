<?php
$this->breadcrumbs=array(
	'Galleries',
);

$this->menu=array(
	array('label'=>'Create Gallery', 'url'=>array('create')),
	array('label'=>'Manage Gallery', 'url'=>array('admin')),
);
?>

<h1>Galleries</h1>

<?php 

foreach($models as $m)
{
        echo CHtml::link($m['title'], array('view', 'id' => $m['id']));
	echo "<br>";
        $c = 0;
	foreach($m['image'] as $i)
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
	echo "<br>";
}

?>
