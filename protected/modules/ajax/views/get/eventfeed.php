<? foreach($events as $event) : ?>
    
        <h5><a href='<?= Yii::app()->baseUrl ?>/event/<?= $event['id'] ?>'><?= $event['title'] ?></a> </br>
        <?= $event['start'] ?></h5>
    
<? endforeach; ?>
