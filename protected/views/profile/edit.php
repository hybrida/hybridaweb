
Endre profil

<?= $fb ?>
    <p>I infotekst-feltet kan du legge til en beskrivelse av deg selv, hjemmeside og eventuelt
    mobilnummer. Denne informasjonen vil kun hybrider kunne se. Brukerlogin går via innsida, og skal være
    godt sikret.</p>
    
    <form action="" method="post">
    
    Ferdig utdannet år: 
    <input type="text" name="graduationYear" size="3" value="<?= /**/ ?>" /><br/>
    
    Studieretning: 
    <select name="specialization">
     <option value="-1">(Avbrutt studie)</option>
     <option value="0" selected="selected">(Ikke valgt)</option>
     <option value="2">Petroleumsfag</option>
     <option value="3">Geomatikk</option>
     <option value="4">Konstruksjonsteknikk</option>
     <option value="5">Marin teknikk</option>
     <option value="7">Produkt & prosess</option>    
    </select>
    
    Født:<br /><br />
    År: 
    <input value="<?= /**/ ?>" size="4" name="born_year" type="text">
    Måned: 
    <input value="<?= /**/ ?>" size="2" name="born_month" type="text">
    Dag: 
    <input value="<?= /**/ ?>" size="2" name="born_day" type="text">
    
    <span style="font-size: 80%"><em>Du kan la datoen stå tom hvis du ikke ønsker at alle skal se den</em></span>
    
    
    Privat epostadresse: <input value="<?= /**/ ?>" size="30" name="email" type="text">
    <br />Det hjelper ikke å skrive inn @stud.ntnu.no adressen din her. 
    Dette er for at vi skal få tak i deg etter at du har gått ut fra NTNU og da mister du epostadressen fra ntnu.
    
    Jobb: <input value="<?= /**/?> " size="30" name="work" type="text">
    
    <br />
    
    Kortnummer: <input value="<?= /**/ ?>" size="10" name="cardnr" type="text"><br/>
    <span style="font-size: 80%"><em>Brukes for å komme inn på Hybridas bedriftspresentasjoner.<br />
    
            <a href="/bilder/kort.jpg" target="_blank">Hvor finner jeg kortnummeret?</a></em></span>
    <br /><br />
    
    Infotekst:
	<br /><br />
    <textarea cols="55" rows="6" wrap="soft" name="tekst"></textarea>
    <br /><br />
    
   
    </form>
   
    
</div>

<div style="margin: 1em 0; padding: 2em; border: dotted 1px red">
    <b>Last opp bilde</b>
	<div class="bildetips"><big>Tips</big> 
	<p>Enkel bilderedigering online:
	<a href="http://snipshot.com" target="_blank">snipshot.com</a>
	</p>
	</div>
	<br /><br />
    <form enctype="multipart/form-data" action="" method="post">
	    <input type="file" name="user_image"><br/>
		<input type="hidden" name="username" value="bjorask"/>
		<em style="font-size: 80%">Du må kanskje refresh'e siden for at det nye bildet skal vises</em>
	    <br/><br/><input value="Last opp" name="new_user_image" type="submit">    
	</form>
</div>

			
