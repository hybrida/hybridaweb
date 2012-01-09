<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Rediger bedrift</h2>

<p>
    Fyll inn informasjon knyttet til bedriften. Felter merket med (*) er obligatoriske.
</p>

<p>
<div id="BK-add-container">
    <form name="editcompanyform" method="post" action="">
	<table>
            <tr>
		<th>Bedriftsnavn*</th>
		<th>
                    <input type='text' name='addedcompany' value='<?php /* echo $_SESSION['addedcompany']; */?>' maxlength="255" onkeyup="ajax_showOptions(this, 'getCompanies', event)" 
			<?php /*
                            if($_SESSION['POSTEDaddedcompany'] != $_SESSION['addedcompany'] || $_SESSION['addedcompany'] == 'Bedriftsnavnet mangler' || $_SESSION['addedcompany'] == 'Bedriften finnes allerede i databasen'){
				echo "style='color: #FF0000;'";
				?> onclick="this.value=''; this.style.color = '#000000';" <?php
				} */
			?> /> Characters (255)
		</th>
            </tr>
            <tr>
		<th>Mailadresse</th>
		<th>
                    <input name="mailadress" type="text" class="textfield" value='<?php /* echo $_SESSION['mailadress']; */?>' maxlength="255" /> Characters (255)
		</th>
            </tr>
            <tr>
		<th>Telefonnummer</th>
		<th>
                    <input name='phonenumber' type="text" value='<?php /* echo $_SESSION['phonenumber']; */ ?>' maxlength="11" class="textfield" id="phonenumber"
                    <?php /*
			if($_SESSION['POSTEDphonenumber'] != $_SESSION['phonenumber'] || $_SESSION['phonenumber'] == 'Ugyldig telefonnummer'){
                            echo "style='color: #FF0000;'";
                    ?> onclick="this.value=''; this.style.color = '#000000';" <?php
                    } */
                    ?> /> Integer > 0 (11)
		</th>                
            </tr>
            <tr>
		<th>Adresse</th>
		<th>
                    <input name="adress" type="text" class="textfield" value='<?php /*echo $_SESSION['adress']; */?>' maxlength="255" /> Characters (255)
		</th>
            </tr>
            <tr>
                <th>Postboks</th>
		<th>
                    <input name="postbox" type="text" class="textfield" value='<?php /* echo $_SESSION['postbox']; */ ?>' maxlength="255" /> Characters (255)
		</th>
            </tr>
            <tr>
		<th>Postnummer</th>
		<th>
                    <input name='postnumber' type="text" value='<?php /* echo $_SESSION['postnumber']; */ ?>' maxlength="11" class="textfield"
                    <?php /*
                        if($_SESSION['POSTEDpostnumber'] != $_SESSION['postnumber'] || $_SESSION['postnumber'] == 'Ugyldig postnummer')	{
                            echo "style='color: #FF0000;'";
			?> onclick="this.value=''; this.style.color = '#000000';" <?php	
                        } */
			?> /> Integer > 0 (11)
		</th>
            </tr>
            <tr>
		<th>Poststed</th>
		<th>
                    <input name="postlocation" type="text" class="textfield" value='<?php /* echo $_SESSION['postlocation']; */ ?>' maxlength="255" /> Characters (255)
		</th>
            </tr>
            <tr>
                <th>Hjemmeside</th>
                <th>
                    <input name="homepage" type="text" class="textfield" value='<?php /* echo $_SESSION['homepage']; */?>' maxlength="255" /> Characters (255)
		</th>
            </tr>
            <tr>
                <th>Undergruppe av</br>(Man kan kun velge bedrifter som allerede finnes i databasen)</th>
                <th>
                    <input type='text' name='subgroup' value='<?php /* echo $_SESSION['subgroup']; */?>' maxlength="255" onkeyup="ajax_showOptions(this, 'getCompanies', event)"
                    <?php /*
			if($_SESSION['POSTEDsubgroup'] != $_SESSION['subgroup'] || $_SESSION['subgroup'] == 'Bedriften finnes ikke i databasen'){
                            echo "style='color: #FF0000;'";
                    ?> onclick="this.value=''; this.style.color = '#000000';" <?php
                    } */
                    ?>/>  Characters (255)
		</th>
            </tr>
            <tr>
		<th>Relevant for studieretning</th>
		<th>
                    <? foreach($specializationNames as $name) : ?>
                        <input type="checkbox" name="specialization[]" value="<?= $name['id'] ?>"
                                        
                            <? foreach($relevantSpecializations as $specialization) : ?>
                                <?= ($name['id'] == $specialization['specializationId'] ? "checked" : ""); ?>
                            <? endforeach ?>
                                        
                        /><?= $name['name'] ?><br/>
                    <? endforeach ?> 
		</th>
            </tr>
            <tr>
                <th>Kontaktet av</br>(Man kan kun velge personer som er medlemmer av gruppen til <?= $this->title ?>)</th>
		<th>
                    <? foreach($membersSum as $info) : ?>
                        <select name="status" size="<?= $info['sum'] ?>">
                            
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
            <tr>
                <th>Status</br>("Ikke kontaktet" er standardvalg i databasen)</th>
                <th>
                    <select name="status" size="4">	
                        <option value="Aktuell senere" style="background:yellow;"
                            <? foreach($status as $info) : ?>
                                <?= ("Aktuell senere" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Aktuell senere
			</option>
			<option value="Blir kontaktet" style="background:#00CC00;"
                            <? foreach($status as $info) : ?>
                                <?= ("Blir kontaktet" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Blir kontaktet
			</option>				
			<option value="Ikke kontaktet" style="background:white;" 
                            <? foreach($status as $info) : ?>
                                <?= ("Ikke kontaktet" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Ikke kontaktet
			</option>	
			<option value="Uaktuell" style="background:#FF0033;"
                            <? foreach($status as $info) : ?>
                                <?= ("Uaktuell" == $info['status'] ? "selected" : ""); ?>
                            <? endforeach ?>
                            >Uaktuell
			</option>					
                    </select>
		</th>
            </tr>
        </table>
        
        <p align="center" >
            <input type="submit" name="Submit" value="Utfør endringer" />
	</p>
    </form>
</div>
</p>