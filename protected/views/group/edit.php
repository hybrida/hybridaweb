
<?= $title ?>

<ul>
<? foreach ($groups as $group): ?>
    <li>
        <?= $group['titleMenu'] ?> |

        <?= $group['openGroup'] == 1 ? "Åpen" : "Privat" ?>
        <?= $group['publicGroup'] == 1 ? "Gjester" : "Innlogget" ?>

        <a href='/yii/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=public'>Public</a>
        <a href='/yii/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=open'>Innloggede</a>
        <a href='/yii/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=private'>Privat</a>   
        <a href='/yii/get/group/?gId=<?= $group['id'] ?>&siteId=<?= $group['siteId'] ?>&type=modTabAccess&access=open'>Slett</a>
        
    </li>

<? endforeach ?>
</ul>


<ul>
<? foreach ($members as $member): ?>
    
    <li>
        <a href='/profile/<?= $member['userId'] ?>'> <?= $member['firstName'] . " " . $member['middleName'] . " " . $member['lastName'] ?></a> <?= $member['comission'] ?>
        <a href='/yii/get/group/?gId=<?= $group['id'] ?>&userId=<?= $member['userId'] ?>&type=delMember'>Slett</a> 
    </li>
        
<? endforeach ?>
</ul>