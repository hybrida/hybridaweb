<?php $this->renderPartial("menu", $menu); ?>

<?= $title ?>

<ul>
<? foreach ($groups as $group): ?>
    <li>
        <?= $group['titleMenu'] ?> |

        <?= $group['openGroup'] == 1 ? "Åpen" : "Privat" ?>
        <?= $group['publicGroup'] == 1 ? "Gjester" : "Innlogget" ?>

        <a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=public'>Public</a>
        <a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=open'>Innloggede</a>
        <a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=private'>Privat</a>   
        <a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=open'>Slett</a>
        
    </li>

<? endforeach ?>
</ul>


<ul>
<? foreach ($members as $member): ?>
    
    <li>
        <a href='<?= Yii::app()->baseURL ?>/profile/<?= $member['id'] ?>'> <?= $member['firstName'] . " " . $member['middleName'] . " " . $member['lastName'] ?></a> <?= $member['comission'] ?>
        <a href='<?= Yii::app()->baseURL ?>/get/group/?gId=<?= $group['id'] ?>&userId=<?= $member['id'] ?>&type=delMember'>Slett</a> 
    </li>
        
<? endforeach ?>
    
    <div class='search' data-url='userSearch' data-type='get/group/?gId=<?= $group['id'] ?>&type=addMember&comission='>
        <input type='text' />
        <div class="searchImg">
                <input type='image' src='<?= Yii::app()->request->baseUrl ?>/images/Search.png' />
        </div>
        <ul id="hintList">

        </ul>
    </div>
    
</ul>