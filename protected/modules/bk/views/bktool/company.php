<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<? foreach($companyContactInfo as $info) : ?>
    <h2><?= $info['companyName'] ?></h2>
<? endforeach ?>

<p>
<table id="BK-company-maintable">
    <tr>
        <td>
            <h3>Informasjon</h3>
            <p>
            <table id="BK-company-informationtable">
                <tr>
                    <th>Mailadresse</th>
                    <td>
                        <? foreach($companyContactInfo as $info) : ?>
                            <?= $info['mail'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Telefonnummer</th>
                    <td>
                        <? foreach($companyContactInfo as $info) : ?>
                            <?= $info['phoneNumber'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td>
                        <? foreach($companyContactInfo as $info) : ?>
                            <?= $info['adress'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Postboks</th>
                    <td>
                        <? foreach($companyContactInfo as $info) : ?>
                            <?= $info['postbox'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Postnr./Poststed</th>
                    <td>
                        <? foreach($companyContactInfo as $info) : ?>
                            <?= $info['postnumber'] ?> <?= $info['postplace'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Hjemmeside</th>
                    <td>
                        <? foreach($companyContactInfo as $info) : ?>
                            <?= $info['homepage'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Undergruppe av</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Relevant for studieretning</th>
                    <td></td>
                </tr>
            </table>
            </p>
            
            <p>
            <table id="BK-company-informationtable">
                <tr>
                    <th>Kontaktet av</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Sist tildelt bedriftskontakt</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Sist oppdatert</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Sist oppdatert av</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Dato lagt til</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Lagt til av</th>
                    <td></td>
                </tr>
            </table>
            </p>
            
        </td>
        <td>
            <h3>Kommentarer</h3>
                <form name='addcommentform' method='post' action=''>
                    <textarea name='comment' value='' rows='1'>
                    <? /*
                        if($_SESSION['addedcomment'] == '' || $_SESSION['addedcomment'] == 'Kommentar mangler'){
                            echo $_SESSION['addedcomment'];
			} */ 
                    ?>
                    </textarea>
							
                    <p align="center"><input type='submit' name='Submit' value='Legg til kommentar' /></p>
                </form>
            <div id="BK-company-scrollcontainer">
                <table id="BK-company-commenttable">
                    <tr>
                        
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr id="BK-company-editinglinks">
        <td>
            <h4><?=CHtml::link('Rediger bedrift', array('editcompany?id='.$companyId))?></h4>
        <td>
            <h4>Fjern bedrift</h4>
        </td>    
    </tr>
    <tr>
        <td>
            <h3>Registrerte bedriftspresentasjoner</h3>
            <div id="BK-company-scrollcontainer">
                <table id="BK-company-listtable">
                    <tr><th>Dato</th></tr>
                </table>
            </div>
        </td>
        <td>
            <? foreach($employedGraduatesSum as $info) : ?>
                <h3>Registrerte alumnistudenter (<?= $info['sum'] ?>)</h3>
            <? endforeach ?>
            <div id="BK-company-scrollcontainer">
                <table id="BK-company-listtable">
                    <tr><th>Navn</th><th>Spesialisering</th><th>År</th></tr>
                    
                    <? $counter = 1; ?>
                    
                    <? foreach($employedGraduates as $graduate) : ?>
                    
                    <? if($counter % 2){ ?>
                        <tr bgcolor='<?= $this->oddRowColour ?>'>
                    <?	}else{ ?>
                        <tr bgcolor='<?= $this->evenRowColour ?>'>
                    <? } ?>
                    
                            <td><a href='/profile/<?= $graduate['id'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
                            <td><?= $graduate['name'] ?></td>
                            <td><?=CHtml::link($graduate['graduationYear'], array('graduationyear?id='.$graduate['graduationYear']))?></td>
                       </tr>
                       
                       <? $counter++; ?>
                    <? endforeach ?>
                </table>
            </div>
        </td>
    </tr>
</table>
</p>