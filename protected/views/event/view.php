<div class='left'>
	<h1><?= $title ?></h1>
</div>

<div class='container'>
	<img src='<?= Yii::app()->baseURL ?>/image/view/id/<?= $imageId ?>/size/2' />
</div>

<div class='right'>
	<b>Starter: </b><i><?= $start ?></i>
</div>

<div class='right'>
	<b>Slutter: </b><i><?= $end ?></i>
</div>

<div class='clear'>
	<?= $content ?>
</div>




<? if ($hasSignup): ?>

    Påmelding:
	<div class="signup" data-id='<?= $id ?>'></div>

    <div class='clear'>
        <b>Plasser: </b><i><?= $spots ?></i>
        <b>Åpner: </b><i><?= $open ?></i>
        <b>Stenger: </b><i><?= $close ?></i>
        
    </div>

<?	endif; ?>