<? foreach($newslist as $news) : ?>


    <div class='contentItem'>
    	<div class='blueBox'>
    		<div class='blueBoxItem'>
    		</div>
    	</div>

    	<div class='topBar'>
    		<div class='topBarItem'>
    		</div>

    <!--//Printer overskrift som link hvis event eller lenger nyhet-->
    <?= ($news['parentType'] == NULL) ? "<h1>" . $news['title'] . "</h1>" : ""  ?>

    <?= ($news['parentType'] != NULL) ? 
        "<a href='" . Yii::app()->request->baseURL ."/". $news['parentType'] . 
            "/" . $news['parentId'] . "'>
            <h1>" . $news['title'] . "</h1>
        </a>" : ""  ?>

    	</div>
    	<div class='articleContent'>

    <!--//Hvis nyheten har bilde-->
    <?= (( $news['imageId']!=null) ? "<img src='" . Yii::app()->request->baseUrl ."/image/view/id/" . $news['imageId'] . "/size/2' />" : "" );  ?>
    	
        <p>

    <!--//Hvis nyheten er for lang hvis en les mer link-->
    <? if(strlen($news['content']) > $contentLength) : ?>
    
            <?= substr($news['content'],0,$contentLength) ?>...
            <a href='<?= Yii::app()->request->baseURL ?>/<?= ($news['parentType'] == NULL) ? "news" : $news['parentType'] ?>/<?= ($news['parentType'] == NULL) ? $news['id'] : $news['parentId'] ?>'>
                Les mer
            </a>
            
    <? else : ?>
            <?= $news['content'] ?>
    <? endif; ?>


    </p>

    <!--//Printer dato og forfatter-->
    <div class='date'><?= $news['timestamp'] ?></div>
    <div class='author'>skrevet av: <a href='<?= Yii::app()->request->baseUrl ?>/profile/<?= $news['userId'] ?>'><?= $news['firstName'] . " " . $news['middleName'] . " " . $news['lastName'] ?> </a></div>
    </div>
    
<? endforeach ?>