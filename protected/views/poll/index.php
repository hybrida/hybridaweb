<?php
/**
 * Created by PhpStorm.
 * User: ivar
 * Date: 12.03.2015
 * Time: 15:42
 */

?>
<h1>Avstemninger</h1>

<? foreach($polls as $pollItem): ?>
    <div class="poll">
        <div class="title"><?=CHtml::link($pollItem->title, $pollItem->getVoteUrl())?></div>
    </div>
<? endforeach; ?>