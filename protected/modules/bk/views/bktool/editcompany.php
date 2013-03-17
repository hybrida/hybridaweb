<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Rediger bedrift</h2>

<p>
    Fyll inn informasjon knyttet til bedriften. Felter merket med (*) er obligatoriske.
</p>

<p>
<form name="editcompanyform" method="post" enctype="multipart/form-data"
    <? foreach($companyContactInfo as $info) : ?>
        action="editcompanyform?id=<?= $info['companyID'] ?>"
    <? endforeach ?>
    >
    <div id="BK-add-container">
	<table id="BK-add-table">
            <tr>
		<th>Bedriftsnavn*</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input type='text' name='editedcompany' value='<?= $info['companyName'] ?>' maxlength="255"/> Characters (255)<br/>
                        <div id="BK-add-errormessage"><i><u><?= $errordata['editedcompanyerror'] ?></u></i></div>
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
		<th>Mailadresse</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name="mail" type="text" class="textfield" value='<?= $info['mail'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
		<th>Telefonnummer</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name='phonenumber' type="text"

                            <? if($info['phoneNumber'] != 0){ ?>
                                value='<?= $info['phoneNumber'] ?>'
                            <? } ?>

                        maxlength="11" class="textfield"/> Integer > 0 (11)<br/>
                        <div id="BK-add-errormessage"><i><u><?= $errordata['phonenumbererror'] ?></u></i></div>
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
		<th>Adresse</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name="address" type="text" class="textfield" value='<?= $info['address'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
                <th>Postboks</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name="postbox" type="text" class="textfield" value='<?= $info['postbox'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
		<th>Postnummer</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name='postnumber' type="text"

                            <? if($info['postnumber'] != 0){ ?>
                                value='<?= $info['postnumber'] ?>'
                            <? } ?>

                        maxlength="11" class="textfield"/> Integer > 0 (11)<br/>
                        <div id="BK-add-errormessage"><i><u><?= $errordata['postnumbererror'] ?></u></i></div>
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
		<th>Poststed</th>
		<th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name="postplace" type="text" class="textfield" value='<?= $info['postplace'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
                <th>Hjemmeside</th>
                <th>
                    <? foreach($companyContactInfo as $info) : ?>
                        <input name="homepage" type="text" class="textfield" value='<?= $info['homepage'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
		</th>
            <tr>
                <th>Prioritet</th>
                <td>
                    <input id="priority" name="priority" type="range" value="<?=$priority ?>" min="0" max="10">
                    <strong><span id="priorityValue"></span></strong>
                </td>
            </tr>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            		<tr>
				<th>
					Logo
				</th>
				<th>
					<? if ($logo !== false): ?>
						<?= Image::tag($logo, "sidebar") ?>
					<? endif; ?>
					<br/>
					<?= CHtml::fileField('logo', 'logo', array('id'=>'logo')); ?>
				</th>
			</tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Undergruppe av</br>(Man kan kun velge bedrifter<br/>som allerede finnes i databasen)</th>
                <th>
                    <select name="parentcompanyid">
                        <option value="0">Ingen valgt</option>

                        <? foreach($companiesList as $company) : ?>
                            <option value="<?= $company['companyID'] ?>"

                                <? foreach($parentCompanyId as $info) : ?>
                                    <? if($info['companyID'] == $company['companyID']){?>
                                        selected
                                    <? } ?>
                                <? endforeach ?>
                            ><?= $company['companyName'] ?></option>
                        <? endforeach ?>
                    </select>
                    <br/><div id="BK-add-errormessage"><i><u><?= $errordata['parentcompanyerror'] ?></u></i></div>
		</th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Medlem av <?= $this->industryAssociation ?></th>
                <th>
                    <input type="checkbox" name="membership[]" value="isMember"
                        <?= ($isMember ? "checked" : ""); ?>
                    />
                </th>
            </tr>
            <tr>
                <th>Relevans for <?= $this->industryAssociation ?></th>
                <th>
                    <select name="relevance" size="3">
                        <option value="Høy" style="color:#00688B;"
                            <? foreach($iktRingenInfo as $info) : ?>
                                <?= ("Høy" == $info['relevance'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Høy
			</option>
			<option value="Middels" style="color:#50A6C2;"
                            <? foreach($iktRingenInfo as $info) : ?>
                                <?= ("Middels" == $info['relevance'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Middels
			</option>
			<option value="Lav" style="color:#B2DFEE;"
                            <? foreach($iktRingenInfo as $info) : ?>
                                <?= ("Lav" == $info['relevance'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Lav
			</option>
                    </select>
		</th>
            </tr>
            <tr>
                <th>Sist kontaktet angående <?= $this->industryAssociation ?></th>
               <th>
                   <input name="datecontacted" type="text" class="textfield"
                    <? foreach($iktRingenInfo as $info) : ?>
                         value='<?= substr($info['dateContacted'], 0, 10) ?>'
                    <? endforeach ?>
                    maxlength="10" /> (YYYY-MM-DD)
                   <div id="BK-add-errormessage"><i><u><?= $errordata['datecontactederror'] ?></u></i></div>
                </th>
            </tr>
        </table>
    </div>

    <? if($isMember){ ?>
        <br/>
        <div id="BK-add-container">
            <table id="BK-add-table">
                <tr>
                    <th>Kontaktperson for faktura</th>
                    <th>
                        <input name="invoicecontact" type="text" class="textfield"
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                             value='<?= $info['invoiceContact'] ?>'
                        <? endforeach ?>
                        maxlength="255" /> Characters (255)
                    </th>
                    </tr>
                <tr>
                   <th>Organisasjonsnummer</th>
                   <th>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                        <input name='organizationnumber' type="text"

                            <? if($info['organizationNumber'] != 0){ ?>
                                value='<?= $info['organizationNumber'] ?>'
                            <? } ?>

                        maxlength="9" class="textfield"/> Integer > 0 (9)<br/>
                        <div id="BK-add-errormessage"><i><u><?= $errordata['organizationnumbererror'] ?></u></i></div>
                         <? endforeach ?>
                    </th>
                </tr>
                <tr>
                    <th>Fakturaadresse</th>
                    <th>
                        <input name="invoiceaddress" type="text" class="textfield"
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                             value='<?= $info['invoiceAddress'] ?>'
                        <? endforeach ?>
                        maxlength="255" /> Characters (255)
                    </th>
                </tr>
                <tr>
                    <th>Medlemskapsavgift</th>
                    <th>
                        <? foreach($iktRingenMembershipInfo as $info) : ?>
                        <input name='membershipfee' type="text"

                            <? if($info['membershipFee'] != 0){ ?>
                                value='<?= $info['membershipFee'] ?>'
                            <? } ?>

                        maxlength="11" class="textfield"/> Integer > 0 (11)<br/>
                        <div id="BK-add-errormessage"><i><u><?= $errordata['membershipfeeerror'] ?></u></i></div>
                         <? endforeach ?>
                    </th>
                    </th>
                </tr>
            </table>
        </div>
    <? } ?>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
		<th>Relevant for studieretning</th>
		<th>
                    <? foreach($specializationNames as $name) : ?>
                        <input type="checkbox" name="specializations[]" value="<?= $name['id'] ?>"

                            <? foreach($relevantSpecializations as $specialization) : ?>
                                <?= ($name['id'] == $specialization['specializationId'] ? "checked" : ""); ?>
                            <? endforeach ?>

                        /><?= $name['name'] ?><br/>
                    <? endforeach ?>
		</th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Kontaktet av</br>(Man kan kun velge personer som er aktive medlemmer av gruppen til <?= $this->title ?>)</th>
		<th>
                    <? foreach($membersSum as $info) : ?>
                        <select name="contactor" size="<?= $info['sum'] ?>">

                            <? foreach($members as $member) : ?>
                                <option value="<?= $member['id'] ?>"

                                    <? foreach($contactor as $info) : ?>
                                        <?= ($member['id'] == $info['id'] ? "selected" : ""); ?>
                                    <? endforeach ?>

                                ><?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?></option>
                            <? endforeach ?>

                    <? endforeach ?>
                        </select>
                </th>
            </tr>
        </table>
    </div>

    <br/>
    <div id="BK-add-container">
        <table id="BK-add-table">
            <tr>
                <th>Status</br>("Ikke kontaktet" er standardvalg i databasen)</th>
                <th>
                    <select name="status" size="4">
                        <option value="Aktuell senere" style="color:#FF9900;"
                            <? foreach($status as $info) : ?>
                                <?= ("Aktuell senere" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Aktuell senere
			</option>
			<option value="Blir kontaktet" style="color:#009900;"
                            <? foreach($status as $info) : ?>
                                <?= ("Blir kontaktet" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Blir kontaktet
			</option>
			<option value="Ikke kontaktet"
                            <? foreach($status as $info) : ?>
                                <?= ("Ikke kontaktet" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Ikke kontaktet
			</option>
			<option value="Uaktuell" style="color:#CC0000;"
                            <? foreach($status as $info) : ?>
                                <?= ("Uaktuell" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Uaktuell
			</option>
                    </select>
		</th>
            </tr>
        </table>
    </div>

    <br/>
    <p id="BK-add-button" align="center" >
        <input type="submit" name="Submit" value="Utfør endringer" />
    </p>
</form>
</p>

<script>
    var priorityRange = document.getElementById('priority');
    var priorityValue = document.getElementById('priorityValue');

    priorityValue.innerHTML = priorityRange.value;

    var onChange = function(e){
        var value = e.srcElement.value;
        priorityValue.innerHTML = value;
    };

    priorityRange.addEventListener("change", onChange, false);
</script>