
<?= $title ?>

<ul>
<? foreach ($groups as $group): ?>
    <li>
        <?= $group['titleMenu'] ?> |

        <?= $group['openGroup'] == 1 ? "Åpen" : "Privat" ?>
        <?= $group['publicGroup'] == 1 ? "Gjester" : "Innlogget" ?>

        <a href='group/<?= $group['id'] ?>/sub/<?= $group['siteId'] ?>'>Innloggede</a>
        <a href='group/<?= $group['id'] ?>/sub/<?= $group['siteId'] ?>'>Privat</a>   
        <a href='group/<?= $group['id'] ?>/sub/<?= $group['siteId'] ?>'>Slett</a>
    </li>

<? endforeach ?>
</ul>


<ul>
<? foreach ($members as $member): ?>
    
    <li>
        <a href='/profile/<?= $member['userId'] ?>'> <?= $member['firstName'] . " " . $member['middleName'] . " " . $member['lastName'] ?></a> <?= $member['comission'] ?>
        <a href='/profile/<?= $member['userId'] ?>'>Slett</a> 
    </li>
        
<? endforeach ?>
</ul>