<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<div id="timetrackerIndex">

<h1>Big Daddy</h1>

<?= CHtml::link("HER", array("form"), array("class" => "g-button")) ?>



<script src="http://code.highcharts.com/highcharts.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script>
	$(function () {
        $('#container').highcharts({
            title: {
                text: 'Arbeid siste 7 dager',
                x: -20 //center
            },
            subtitle: {
                text: 'Husk at du bare konkurrer med deg selv!',
                x: -20
            },
            yAxis: {
                title: {
                    text: 'Antall timer (rad/sek)'
                },

            },
            tooltip: {
                valueSuffix: ' rad/sek'
            },
            plotOptions: {
                line: {
                    animation: false
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: <?= $graph ?>
        });
    });



</script>

</div>