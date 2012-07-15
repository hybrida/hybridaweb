<?php $this->renderPartial("_menu", array()); ?>


<h1><?= $this->title ?></h1>

<h2>Administrer medlemmer</h2>
<p>
    Sletting av et medlem flytter medlemmet til listen over tidligere medlemmer og setter status til alle bedrifter som medlemmet kontakter til 'Aktuell senere'.
</p>

<form name='editmembersform' method='post' action='editmembersform'>
    <br/>
    <h3>Legg til nye medlemmer</h3>
    <table id="BK-index-member-supporttable">
        <tr>
            <td>
                <table id="BK-index-addmember-table">
                    <tr>
                        <th>Bruker</th>
                        <th>Stilling</th>
                    </tr>
                    <? for($i = 0; $i < 4; $i += 1) { ?>
                    <tr>
                        <td>                        
                            <select name="addedmembers[]">
                                <option value="0">Ingen valgt</option>
                                    <? foreach($userList as $user) : ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['firstName']." ".$user['middleName']." ".$user['lastName'] ?></option>
                                    <? endforeach ?>
                            </select>
                        </td>
                        <td><input name="addedcomissions[]" type="text" class="textfield" maxlength="50" /></td>
                    </tr>
                    <? } ?>  
                </table>
            </td>
            <td id="BK-index-buttoncell">
                <input type="submit" name="Submit" value="Legg til alle endringer" />
            </td>
        </tr>
    </table>
    
    <? if(isset($errordata)){?>
        <? foreach($errordata as $error) : ?>
            <br/><div id="BK-add-errormessage"><i><u><?= $error ?></u></i></div>
        <? endforeach ?>
    <? } ?>

    <br/>
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
                    <td><?=CHtml::link('Rediger', array('editmember?id='.$member['id']))?></td>
                    <td id="BK-index-checkboxcell"><input type='checkbox' name='selectedmembers[]' value='<?= $member['id'] ?>' /></td>
                </tr>
            <? endforeach; ?>
    </table>
</form>
    
<br/>
<h3>Tidligere medlemmer:</h3>

<table id="BK-index-member-table">
        <tr>
            <th></th>
            <th>Navn</th>
            <th>Stilling</th>
            <th>Medlem fra</th>
            <th>Medlem til</th>
            <th>Rediger</th>
        </tr>
        <? foreach ($formerMembers as $member): ?>
            <tr>
                <td><?= Image::profileTag($member['imageId'], 'mini') ?></td>
                <td><a href='/profil/<?= $member['username'] ?>'> <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></a></td>
                <td><?= $member['comission'] ?></td>
                <td><?= $member['start'] ?></td>
                <td><?= $member['end'] ?></td>
                <td><?=CHtml::link('Rediger', array('editmember?id='.$member['id']))?></td>
            </tr>
        <? endforeach; ?>
</table>