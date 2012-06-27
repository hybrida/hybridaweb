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
                            <? if($info['phoneNumber'] != 0){ ?>
                                <?= $info['phoneNumber'] ?>
                            <? } ?>
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
                            <? if($info['postnumber'] != 0){ ?>
                                <?= $info['postnumber'] ?>
                            <? } ?>
                            <?= $info['postplace'] ?>
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
                    <td>
                        <? foreach($parentCompanyName as $info) : ?>
                            <?= CHtml::link($info['companyName'], array('company?id='.$info['companyID'])) ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Relevant for studieretning</th>
                    <td>
                        <? foreach($relevantSpecializations as $specialization) : ?>
                            <?= $specialization['name'] ?><br/>
                        <? endforeach ?>
                    </td>
                </tr>
            </table>
            </p>
            
            <p>
            <table id="BK-company-informationtable">
                <tr>
                    <th>Kontaktet av</th>
                    <td>
                        <? foreach($contactor as $info) : ?>
                            <a href='/profil/<?= $info['username'] ?>'><?= $info['firstName'] ?> <?= $info['middleName'] ?> <?= $info['lastName'] ?></a>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Sist tildelt bedriftskontakt</th>
                    <td>
                        <? foreach($timestamps as $timestamp) : ?>
                            <?= $timestamp['dateAssigned'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Sist oppdatert</th>
                    <td>
                        <? foreach($timestamps as $timestamp) : ?>
                            <?= $timestamp['dateUpdated'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Sist oppdatert av</th>
                    <td>
                        <? foreach($updater as $info) : ?>
                            <a href='/profil/<?= $info['username'] ?>'><?= $info['firstName'] ?> <?= $info['middleName'] ?> <?= $info['lastName'] ?></a>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <? foreach($status as $info) : ?>
           
                        <? switch ($info['status']){
                                case "Aktuell senere": ?>
                                    <td bgcolor="yellow">
                        <?          break;
                                case "Blir kontaktet": ?>
                                    <td bgcolor="#00CC00">
                        <?          break;
                                case "Ikke kontaktet": ?>
                                    <td bgcolor='#FFFFFF'>
                        <?          break;
                                case "Uaktuell": ?>
                                    <td bgcolor="#FF0033">
                        <?          break;
                                default: ?>
                                    <td bgcolor='#FFFFFF'>
                        <? } ?>
                
                        <?= $info['status'] ?></td>
                    <? endforeach ?>
                </tr>
                <tr>
                    <th>Dato lagt til</th>
                    <td>
                        <? foreach($timestamps as $timestamp) : ?>
                            <?= $timestamp['dateAdded'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Lagt til av</th>
                    <td>
                        <? foreach($adder as $info) : ?>
                            <a href='/profil/<?= $info['username'] ?>'><?= $info['firstName'] ?> <?= $info['middleName'] ?> <?= $info['lastName'] ?></a>
                        <? endforeach ?>
                    </td>
                </tr>
            </table>
            </p>
            
        </td>
        <td>
                <h3>Registrerte bedriftspresentasjoner</h3>
                <div id="BK-company-scrollcontainer">
                    <table id="BK-company-listtable">
                        <tr><th>Dato</th></tr>
                    </table>
                </div>
            </td>
        </tr>
        </table>
    </tr>
    <tr>
        <table id="BK-company-maintable">
        <tr>
        <td>
            <? foreach($commentsSum as $info) : ?>
                <h3>Kommentarer (<?= $info['sum'] ?>)</h3>
            <? endforeach ?>
                <form name='addcommentform' method='post'
                    <? foreach($companyContactInfo as $info) : ?>
                        action='addcommentform?id=<?= $info['companyID'] ?>'
                    <? endforeach ?>
                    >
                    <textarea name='comment' value='' rows='1'><? /*
                        if($_SESSION['addedcomment'] == '' || $_SESSION['addedcomment'] == 'Kommentar mangler'){
                            echo $_SESSION['addedcomment'];
			} */ 
                    ?></textarea>
							
                    <p align="center"><input type='submit' name='Submit' value='Legg til kommentar' /></p>
                </form>
            <div id="BK-company-scrollcontainer">
                <table id="BK-company-commenttable">
                    <? foreach($comments as $comment) : ?>
                        <tr>
                            <td>
                                <p><i>
                                    <?= Image::profileTag($comment['imageId'], 'mini') ?>
                                    <?= $comment['firstName'] ?> <?= $comment['middleName'] ?> <?= $comment['lastName'] ?>, <?= $comment['timestamp'] ?>
                                </i></p>
                                <?= nl2br($comment['content']);?>
                            </td>
                        </tr>
                    <? endforeach ?>
                </table>
            </div>
        </td>
        </tr>
        </table>
    </tr>
    <tr>
        <table id="BK-company-maintable">
            <tr>
            <td>
            <? foreach($employedGraduatesSum as $info) : ?>
                <h3>Registrerte alumnistudenter (<?= $info['sum'] ?>)</h3>
            <? endforeach ?>
            <div id="BK-company-scrollcontainer">
                <table id="BK-company-listtable">
                    <tr><th></th><th>Navn</th><th>År</th><th>Spesialisering</th><th>Alternativ-Email</th><th>Stillingsbeskrivelse</th><th>Arbeidssted</th></tr>
                    
                    <? $counter = 1; ?>
                    
                    <? foreach($employedGraduates as $graduate) : ?>
                    
                    <? if($counter % 2){ ?>
                        <tr bgcolor='<?= $this->oddRowColour ?>'>
                    <?	}else{ ?>
                        <tr bgcolor='<?= $this->evenRowColour ?>'>
                    <? } ?>
                            
                            <td><?= Image::profileTag($graduate['imageId'], 'mini') ?></td>
                            <td><a href='/profil/<?= $graduate['username'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
                            <td><?=CHtml::link($graduate['graduationYear'], array('graduationyear?id='.$graduate['graduationYear']))?></td>
                            <td><?= $graduate['name'] ?></td>
                            <td><?= $graduate['altEmail'] ?></td>
                            <td><?= $graduate['workDescription'] ?></td>
                            <td><?= $graduate['workPlace'] ?></td>
                       </tr>
                       
                       <? $counter++; ?>
                    <? endforeach ?>
                </table>
            </div>
            </td>
            </tr>
        </table>
    </tr>
    <tr>
        <table id="BK-company-maintable">
            <tr id="BK-company-editinglinks">
                <td>
                    <h4><?=CHtml::link('Rediger bedrift', array('editcompany?id='.$companyId))?></h4>
                <td>
                    <h4>Fjern bedrift</h4>
                </td>    
            </tr>
        </table>
    </tr>
</table>
</p>