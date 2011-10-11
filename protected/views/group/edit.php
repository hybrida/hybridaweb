
<?= $title ?>

<ul>
<? foreach ($groups as $group): ?>
    <li>
        <a href='<?= $group['id'] ?>\sub\<?= $group['menuId'] ?>'><?= $group['titleMenu'] ?></a> 

        <?= $group['openGroup'] == 1 ? "Åpen" : "Privat" ?>
        <?= $group['publicGroup'] == 1 ? "Gjester" : "Innlogget" ?>

        <a href='<?= $group['id'] ?>\sub\<?= $group['menuId'] ?>'>Innloggede</a>
        <a href='<?= $group['id'] ?>\sub\<?= $group['menuId'] ?>'>Privat</a>   
        <a href='<?= $group['id'] ?>\sub\<?= $group['menuId'] ?>'>Slett</a>
    </li>

<? endforeach ?>
</ul>


<ul>
<? foreach ($members as $member): ?>
    
    <li>
        <a href='<?= $member['userId'] ?>'> <?= $member['firstName'] . " " . $member['middleName'] . " " . $member['sirName'] ?></a> <?= $member['comission'] ?>
        <a href='<?= $member['userId'] ?>'>Slett</a> 
    </li>
        
<? endforeach ?>
</ul>