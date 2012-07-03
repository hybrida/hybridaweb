<?php $this->renderPartial("_menu", array()); ?>


<h1><?= $this->title ?></h1>

<h2>Administrer medlemmer</h2>

<p>
    Sletting av et medlem flytter medlemmet til listen over tidligere medlemmer.
</p>

<? foreach($membersSum as $sum) : ?>
    <h3>Aktive medlemmer (<?= $sum['sum'] ?>):</h3>
<? endforeach; ?>
<table id="BK-index-member-table">
        <tr>
            <th></th>
            <th>Navn</th>
            <th>Stilling</th>
            <th>Brukernavn</th>
            <th>Medlem fra</th>
            <th>Rediger</th>
            <th>Slett</th>
        </tr>
        <? foreach ($members as $member): ?>
            <tr>
                <td><?= Image::profileTag($member['imageId'], 'mini') ?></td>
                <td><a href='/profil/<?= $member['username'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></td>
                <td><?= $member['comission'] ?></td>
                <td><?= $member['username'] ?></td>
                <td><?= $member['start'] ?></td>
                <td>Rediger</td>
                <td></td>
            </tr>
        <? endforeach; ?>
</table>