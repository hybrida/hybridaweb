<? foreach($events as $event) : ?>

    <a href=?site=event&id=<?= $event['id']?> >
        <div>
            <?= $event['title'] ?>
        </div>
        <div class='right'>
            <?= $event['start'] ?>
        </div>
    </a>

    <?= $split ?>
 
<? endforeach; ?>

