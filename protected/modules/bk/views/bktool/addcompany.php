<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Legg til bedrift</h2>

<p>
    Fyll inn informasjon knyttet til bedriften. Felter merket med (*) er obligatoriske.
</p>

<p>

<form name="addcompanyform" method="post" action="addcompanyform">
    <div id="BK-add-container">
	<table id="BK-add-table">
            <tr>
		<th>Bedriftsnavn*</th>
		<th>
                    <input type='text' name='addedcompany' maxlength="255" /> Characters (255)<br/>
                    <div id="BK-add-errormessage"><i><u><?= $errordata['addedcompanyerror'] ?></u></i></div>
                </th>
            </tr>
            <tr>
		<th>Mailadresse</th>
		<th><input name="mail" type="text" class="textfield" maxlength="255" /> Characters (255)</th>
            </tr>
            <tr>
		<th>Telefonnummer</th>
		<th>
                    <input name='phonenumber' type="text" maxlength="11" class="textfield" /> Integer > 0 (11)<br/>
                    <div id="BK-add-errormessage"><i><u><?= $errordata['phonenumbererror'] ?></u></i></div>
                </th>                
            </tr>
            <tr>
		<th>Adresse</th>
		<th><input name="adress" type="text" class="textfield" maxlength="255" /> Characters (255)</th>
            </tr>
            <tr>
                <th>Postboks</th>
		<th><input name="postbox" type="text" class="textfield" maxlength="255" /> Characters (255)</th>
            </tr>
            <tr>
		<th>Postnummer</th>
		<th>
                    <input name='postnumber' type="text" maxlength="11" class="textfield"/> Integer > 0 (11)<br/>
                    <div id="BK-add-errormessage"><i><u><?= $errordata['postnumbererror'] ?></u></i></div>
                </th>
            </tr>
            <tr>
		<th>Poststed</th>
		<th><input name="postplace" type="text" class="textfield" maxlength="255" /> Characters (255)</th>
            </tr>
            <tr>
                <th>Hjemmeside</th>
                <th><input name="homepage" type="text" class="textfield" maxlength="255" /> Characters (255)</th>
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
                                <option value="<?= $company['companyID'] ?>"><?= $company['companyName'] ?></option>
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
                        <input type="checkbox" name="specializations[]" value="<?= $name['id'] ?>"/><?= $name['name'] ?><br/>
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
                                <option value="<?= $member['id'] ?>">
                                    <?= $member['firstName'] ?> <?= $member['middleName'] ?> <?= $member['lastName'] ?>
                                </option>
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
                        <option value="Aktuell senere" style="color:#FF9900;">Aktuell senere</option>
			<option value="Blir kontaktet" style="color:#009900;">Blir kontaktet</option>				
			<option value="Ikke kontaktet" selected>Ikke kontaktet</option>	
			<option value="Uaktuell" style="color:#CC0000;">Uaktuell</option>					
                    </select>
		</th>
            </tr>
        </table>
        </table>
    </div>
        
    <br/>
    <p id="BK-add-button" align="center" >
        <input type="submit" name="Submit" value="Legg til bedrift" />
    </p>
</form>
</p>