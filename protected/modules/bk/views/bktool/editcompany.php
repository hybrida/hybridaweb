<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Rediger bedrift</h2>

<p>
    Fyll inn informasjon knyttet til bedriften. Felter merket med (*) er obligatoriske.
</p>

<p>
<form name="editcompanyform" method="post"
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