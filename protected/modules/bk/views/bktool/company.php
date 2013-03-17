<?php $this->renderPartial("_menu", array()); ?>

<? if ($logo != false): ?>
<div style="float: right;">
	<br>
	<?= Image::tag($logo, "sidebar"); ?>
</div>
<? endif; ?>
 
<div style="float: left;">
	<h1>
            <?= $this->title ?>
	</h1>

	<? foreach($companyContactInfo as $info) : ?>
		<h2><?= $info['companyName'] ?></h2>
	<? endforeach ?>
</div>

<p>
<table id="BK-company-uppertable">
    <tr>
    <td id="BK-company-column">
        <h3>Informasjon</h3>
        <p>
        <table id="BK-company-informationtable">
            <tr>
                <th>Mailadresse</th>
                <td>
                    <? foreach($companyContactInfo as $info) : ?>
                        <a href="mailto:<?= $info['mail'] ?>"><?= $info['mail'] ?></a> 
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
                        <?= $info['address'] ?>
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
                        <?= Html::externalLink($info['homepage'], $info['homepage'], null)?>
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
                                <td id ="BK-company-aktuell-senere">
                    <?          break;
                            case "Blir kontaktet": ?>
                                <td id="BK-company-blir-kontaktet">
                    <?          break;
                            case "Ikke kontaktet": ?>
                                <td id="BK-company-ikke-kontaktet">
                    <?          break;
                            case "Uaktuell": ?>
                                <td id="BK-company-uaktuell">
                    <?          break;
                            default: ?>
                                <td>
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

            <tr>
                <th>Prioritet</th>
                <td><?= $priority ?></td>
            </tr>
        </table>
        </p>
    </td>
    <td id="BK-company-column">
            <div id="BK-company-presentationscontainer">
            <? foreach($presentationsCount as $count) : 
                $sumOfAllPresentations += $count['sum'];
            endforeach ?>
                
            <? foreach($oldPresentationsCount as $count) : 
                $sumOfAllPresentations += $count['sum'];
            endforeach ?>
            
                <h3>Registrerte bedriftspresentasjoner (<?= $sumOfAllPresentations ?>)</h3>
                
                <table id="BK-company-presentationtable">
                    <tr>
                        <th>Dato</th>
                    </tr>
                    <? foreach($presentationDates as $date) : ?>
                        <tr><td>
                            <? if($date['bpcID'] > 0){ ?>
                                <?=CHtml::link($date['start'], array('/bedpres/'.$date['bpcID'].'/'.$date['title']))?>
                            <? }else{ ?>
                                <?= $date['start'] ?>
                            <? } ?>
                        </td></tr>
                    <? endforeach ?>
                        
                    <? foreach($oldPresentationDates as $date) : ?>
                        <tr><td><?= $date['date'] ?></td></tr>
                    <? endforeach ?>
                </table>
            </div>
        </td>
    </tr>
</table>

<table id="BK-company-uppertable">
   <tr>
        <td id="BK-company-column">
            <h3><?= $this->industryAssociation ?></h3>
            <p>
                <table id="BK-company-informationtable">
                  <tr>
                    <th>Medlemskap i <?= $this->industryAssociation ?></th>
                    <td>
                        <? if($isMember){ ?>
                            Medlem
                        <? } else { ?>
                            Ikke medlem
                        <? } ?>
                    </td>
                </tr>
                <tr>
                    <th>Relevans for <?= $this->industryAssociation ?></th>
                    <td>
                        <? foreach($iktRingenInfo as $info) : ?>
                            
                            <? switch ($info['relevance']){
                                case "Høy": ?>
                                    <td id ="BK-company-high-relevance">
                            <?      break;
                                case "Middels": ?>
                                    <td id="BK-company-medium-relevance">
                            <?      break;
                                case "Lav": ?>
                                    <td id="BK-company-low-relevance">
                            <?      break;
                                default: ?>
                                    <td>
                            <? } ?>
                        
                            <?= $info['relevance'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Sist kontaktet angående <?= $this->industryAssociation ?></th>
                    <td>
                        <? foreach($iktRingenInfo as $info) : ?>
                            <?= $info['dateContacted'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                </table>
            </p>
            
            <? if($isMember){ ?>
            <p>
            <table id="BK-company-informationtable">
                 <tr>
                    <th>Medlemskap startet</th>
                    <td>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                            <?= $info['start'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Kontaktperson for faktura</th>
                    <td>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                            <?= $info['invoiceContact'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Organisasjonsnummer</th>
                    <td>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                            <?= $info['organizationNumber'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th>Fakturaadresse</th>
                    <td>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                            <?= $info['invoiceAddress'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
                    <tr>
                    <th>Medlemskapsavgift</th>
                    <td>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                            <?= $info['membershipFee'] ?>
                        <? endforeach ?>
                    </td>
                </tr>
            </table>
            </p>
            <? } ?>
        </td>
   </tr>
</table>

<table id="BK-company-centertable">
    <tr id="BK-company-editinglinks">
        <td id="BK-company-column">
                <h4><?=CHtml::link('Rediger bedrift', array('editcompany?id='.$companyId))?></h4>
            </div>
        <td id="BK-company-column">
                <h4>Fjern bedrift</h4>
        </td>
    </tr>
</table>

<table id="BK-company-commenttable">
    <tr>
        <td id="BK-company-column">
                <? foreach($commentsSum as $info) : ?>
                    <h3>Kommentarer (<?= $info['sum'] ?>)</h3>
                <? endforeach ?>
                    <form name='addcommentform' method='post'
                        <? foreach($companyContactInfo as $info) : ?>
                            action='addcommentform?id=<?= $info['companyID'] ?>'
                        <? endforeach ?>
                        >
                        <textarea name='comment' value='' rows='1'></textarea>

                        <p align="center"><input type='submit' name='Submit' value='Legg til kommentar' /></p>
                    </form>
                <div id="BK-company-commentscontainer">
                    <table id="BK-company-commentstable">
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

<table id="BK-company-graduatetable">
    <tr>
    <td id="BK-company-column">
        <? foreach($employedGraduatesSum as $info) : ?>
            <h3>Registrerte alumnistudenter (<?= $info['sum'] ?>)</h3>
        <? endforeach ?>
            <div id="BK-company-alumnicontainer">
            <table id="BK-company-graduatestable">
                <tr><th></th><th>Navn</th><th>År</th><th>Spesialisering</th><th>Alternativ-Email</th></tr>

                <? $counter = 1; ?>

                <? foreach($employedGraduates as $graduate) : ?>

                    <tr> 
                        <td><?= Image::profileTag($graduate['imageId'], 'mini') ?></td>
                        <td><a href='/profil/<?= $graduate['username'] ?>'> <?= $graduate['firstName'] ?> <?= $graduate['middleName'] ?> <?= $graduate['lastName'] ?></a></td>
                        <td><?=CHtml::link($graduate['graduationYear'], array('graduationyear?id='.$graduate['graduationYear']))?></td>
                        <td><?= $graduate['name'] ?></td>
                        <td><?= $graduate['altEmail'] ?></td>
                   </tr>

                   <? $counter++; ?>
                <? endforeach ?>
            </table>
            </div>
    </td>
    </tr>
</table>
</p>