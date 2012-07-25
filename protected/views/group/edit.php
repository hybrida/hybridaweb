<?php $this->renderPartial("menu", $menu); ?>

<h1>
    <?= $title ?>
</h1>

<p>
<table>
    <? foreach ($groups as $group): ?>
        <tr>
            <td><?= $group['titleMenu'] ?></td>
            
            <td><?= $group['openGroup'] == 1 ? "Åpen" : "Privat" ?></td>
            <td><?= $group['publicGroup'] == 1 ? "Gjester" : "Innlogget" ?></td>
            
            <td><a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=public'>Public</a></td>
            <td><a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=open'>Innloggede</a></td>
            <td><a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=private'>Privat</a></td>  
            <td><a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=open'>Slett</a></td>

        </tr>

    <? endforeach ?>
</table>
</p>

<? $counter = 1; ?>

<p>
<div class="g-membertable">
    <table>
        
        <tr>
            <th></th><th>Navn</th><th>Stilling</th><th>Medlem siden</th><th></th>
        </tr>
        
        <? foreach ($members as $member): ?>

            <? if($counter % 2){ ?>
                <tr bgcolor='#CCFFFF'>
            <?	}else{ ?>
                <tr bgcolor='#FFFFFF'>
            <? } ?>
                
                <td><img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $member['imageId'] ?>/size/3'/></td>
                <td><a href='<?= Yii::app()->baseURL ?>/profile/<?= $member['id'] ?>'> <?= $member['firstName'] . " " . $member['middleName'] . " " . $member['lastName'] ?></a></td>
                <td><?= $member['comission'] ?></td>
                <td><?= $member['start'] ?></td>
                <td><a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&userId=<?= $member['id'] ?>&type=delMember'>Slett</a></td>
            </tr>
            
            <? $counter++; ?>

        <? endforeach ?>
    </table>
</div>
</p>
    
    <div class='search' data-url='addUserGroupSearch' data-type='get/group/?gId=<?= $group['id'] ?>'>
        <input type='text' />
        <div class="searchImg">
                <input type='image' src='<?= Yii::app()->request->baseUrl ?>/images/Search.png' />
        </div>
        <ul id="hintList">

        </ul>
    </div>
    