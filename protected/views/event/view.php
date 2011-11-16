<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# lfhybrida: http://ogp.me/ns/fb/lfhybrida#">
      <meta property="fb:app_id"      content="202808609747231" /> 
      <meta property="og:type"        content="lfhybrida:company_presentation" /> 
      <meta property="og:url"         content="http://appletini.ivt.ntnu.no<?= Yii::app()->baseURL ?>/event/<?= $id ?>" /> 
      <meta property="og:title"       content="<?= $title ?>" /> 
      <meta property="og:description" content="<?= $content ?>" /> 
      <meta property="og:image"       content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" />


<div class='left'>
	<h1><?= $title ?></h1>
</div>

<div class='container'>
	<img src='/get/image/<?= $imageId ?>/?size=2' />
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