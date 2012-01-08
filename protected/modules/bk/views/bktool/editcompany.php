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
		<th>Relevant for studieretning</br>(Valg av "Alle" overskriver de andre valgene)</th>
		<th>
                    <input type="checkbox" name="specialication[]" value="Alle"
						<?php /*
							if(!empty($_SESSION['specialication']))
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Alle')
									{
										echo "checked";
										$alle = true;
									}
								}
								unset($name);
							} */ ?> 
                    />Alle<br />
                    <input type="checkbox" name="specialication[]" value="Geomatikk" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Geomatikk')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Geomatikk<br />
                    <input type="checkbox" name="specialication[]" value="Integrerte operasjoner" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Integrerte operasjoner')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Integrerte operasjoner<br />
                    <input type="checkbox" name="specialication[]" value="Konstruksjonsteknikk" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Konstruksjonsteknikk')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Konstruksjonsteknikk<br />
                    <input type="checkbox" name="specialication[]" value="Marin teknikk" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Marin teknikk')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Marin teknikk<br />
                    <input type="checkbox" name="specialication[]" value="Petroleumsfag" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Petroleumsfag')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Petroleumsfag<br />
                    <input type="checkbox" name="specialication[]" value="Produksjon og ledelse" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Produksjon og ledelse')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Produksjon og ledelse<br />
                    <input type="checkbox" name="specialication[]" value="Produkt og prosess"
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Produkt og prosess')
									{
										echo "checked";
									}
								}
								unset($name);
							} */ ?> 
                    />Produkt og prosess<br />
                    <input type="checkbox" name="specialication[]" value="Produktutvikling og materialer" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Produktutvikling og materialer')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Produktutvikling og materialer<br />
                    <input type="checkbox" name="specialication[]" value="Varme- og strømningsteknikk" 
						<?php /*
							if(!empty($_SESSION['specialication']) && !$alle)
							{
								foreach($_SESSION['specialication'] as $name)
								{
									if($name == 'Varme- og strømningsteknikk')
									{
										echo "checked";
									}
								}
								unset($name);
							} */?> 
                    />Varme- og strømningsteknikk<br />
		</th>
            </tr>
            <tr>
                <th>Kontaktet av</br>(Man kan kun velge personer som er medlemmer av gruppen til <?= $this->title ?>)</th>
		<th>
						<?php /*
							//henter ut antall medlemmer i databasen
							$query  = "SELECT COUNT(DISTINCT Personnavn) AS Sum FROM Person";
							$result = mysql_query($query);
							$row = mysql_fetch_assoc($result);
							
							echo "<select name='contactedby' size='".$row['Sum']."'>";
						
							//frigjør informasjonen knyttet til forrige resultater for å gjøre plass til ny spørring
							mysql_free_result($result);
							
							//henter ut navnene på alle medlemmene i databasen
							$query  = "SELECT Personnavn FROM Person ORDER BY Personnavn";
							$result = mysql_query($query);
							
							while($row = mysql_fetch_assoc($result))
							{
								echo "<option value='".$row['Personnavn']."' ";
								
									//hvis det er blitt valgt en person og en feilmelding oppstår, sørger denne if-setningen for at valget blir husket
									if($row['Personnavn'] == $_SESSION['contactedby'])
									{
										echo "selected";
									}
								echo ">";
									echo $row['Personnavn'];
								echo "</option>";
							}
							
							//frigjør informasjonen knyttet til forrige resultater for å gjøre plass til ny spørring
							mysql_free_result($result);
							
							echo "</select>";
					*/	?>
                </th>
            </tr>
            <tr>
                <th>Status</br>("Ikke kontaktet" er standardvalg)</th>
                <th>
                    <select name="status" size="4">	
                        <option value="Aktuell senere" style="background:yellow;"
							<?php /*
								if($_SESSION['status'] == 'Aktuelt senere')
								{
									echo "selected";
								}
							*/?>
                                                        
                            >Aktuelt senere
			</option>
			<option value="Blir kontaktet" style="background:#00CC00;"
							<?php /*
								if($_SESSION['status'] == 'Blir kontaktet')
								{
									echo "selected";
								} */
							?>
                            >Blir kontaktet
			</option>				
			<option value="Ikke kontaktet" style="background:white;" 
							<?php /*
								if($_SESSION['status'] == 'Ikke kontaktet')
								{
									echo "selected";
								}
								if(!isset($_SESSION['status']))
								{
									echo "selected";
								} */
							?>
                            >Ikke kontaktet
			</option>	
			<option value="Uaktuell" style="background:#FF0033;"
							<?php /*
								if($_SESSION['status'] == 'Uaktuell')
								{
									echo "selected";
								} */
							?>
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