<h1><?= $title ?></h1>

<?php $this->renderPartial("menu"); ?>
    
<h2>Kommentarer:</h2>

<div class='comment' data-id='<?= $id ?>' data-type='group'>
    <form>
        <input type='text' name='data-content'/>
    </form>
    <ul data-id='<?= $id ?>' data-type='group' data-src='comment'></ul>
</div>	