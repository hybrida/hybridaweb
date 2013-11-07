<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);

$motivational_quotes = array(
    'Det er DU som bestemmer over DIN tid!',
    "Det viktigste er ikke å vinne, men å delta",
    "Husk at du bare konkurrer med deg selv!",
    "Be the person you want to live your life as![sic]",
    'To hell with circumstances; I create opportunities." – Bruce Lee',
    '"Time is the coin of life. Only you can determine how it will be spent." – Carl Sandburg',
    '"I get knocked down. But I get up again. You’re never going to keep me down." – Chumbawamba',
    '"Character is the result of two things: mental attitude and the way we spend our time." – Elbert Green Hubbard',
    '"When it’s time to die, let us not discover that we have never lived." -Henry David Thoreau',
    '"Nothing contributes so much to tranquilize the mind as a steady purpose– a point on which the soul may fix its intellectual eye." – Mary Shelley',
    '"There is no such thing as failure. There are only results." – Tony Robbins',
    '"To different minds, the same world is a hell, and a heaven." – Ralph Waldo Emerson',
    '"It’s great to be great, but its greater to be human." – Will Rogers',
    '"Do not wait to strike till the iron is hot; but make it hot by striking." – William B. Sprague ',
    'One day your life will flash before your eyes. Make sure it\'s worth watching.',
);
$quote = $motivational_quotes[array_rand($motivational_quotes)];

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
                    text: 'Arbeid siste 14 dager',
                    x: -20 //center
                },
                subtitle: {
                    text: '<?= $quote ?>',
                    x: -20
                },
                yAxis: {
                    title: {
                        text: 'timer'
                    },

                },
                xAxis: {
                	categories: <?= $dates ?>,
                	title: {
                		text: "<?= date('F', time()) ?>"
                	}
                },
                tooltip: {
                    valueSuffix: ' timer',
                    shared: true,
                    crosshairs: true
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
                series: <?= $series ?>
            });
        });

    </script>

    <h2>Arbeid siste 7 dager</h2>
    <h3>Ikke med dagen i dag</h3>

    <style>
        #timetrackerIndex table tr:nth-child(odd){
            background-color: #ffc;
        }

        #timetrackerIndex table tr:nth-child(1) {
            background-color: #ddd;
        }

        #timetrackerIndex table {
            border-collapse: collapse;

        }


        #timetrackerIndex table th,
        #timetrackerIndex table td {
            padding: 0.4em;
            border: 1px solid black;
        }
    </style>
    <table>
        <tr>
            <th>#</th>
            <th>Navn</th>
            <th>Timer</th>
            <th>Timer / arbeidsdag</th>
        </tr>
        <?php foreach ($history as $nr =>$hist): ?>
            <tr>
                <th><?= $nr+1 ?></th>
                <th><?= $hist['name'] ?></th>
                <td><?= $hist['hours'] ?></td>
                <td><?= $hist['hours']/5 ?></td>
            </tr>
        <?php endforeach ?>
    </table>


</div>