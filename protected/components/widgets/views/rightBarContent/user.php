<img class='block' src="<?= Yii::app()->request->baseUrl ?>/image/view/id/<?=$imageId ?>/size/1" width="248px">

<div class='barText'></div>
  
<div class='barTitle'>Kalender</div>
<table class='calendar'>
    <tr>
        <td><img src="<?= Yii::app()->request->baseUrl ?>/images/icons/calender_back.png"></td>
        <td colspan=5></td>
        <td><img src="<?= Yii::app()->request->baseUrl ?>/images/icons/calender_forward.png"></td>
    </tr>

    <tr><td>M</td><td>T</td><td>O</td><td>T</td><td>F</td><td>L</td><td>S</td></tr>
    <tr><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td></tr>
    <tr><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td></tr>
    <tr><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td></tr>
    <tr><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td></tr>
    <tr><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td></tr>
    <tr><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td><td id='days'</td></tr>
</table>

<div class='barTitle'><?= $firstName ?>s aktiviteter</div>

<div class='feed' data-src='eventfeed'></div>