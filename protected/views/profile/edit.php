<h1>Endre profil</h1>
<div class="formSection">
    <div class="fieldDefinition">Fyll inn info fra Facebook:</div>

    <div class="fieldInput"><?= $fb ?></div>

    <div class="fieldExplanation">
        Henter personlig info fra Facebook så du slipper gjøre det selv!
    </div>
</div>

<form action="" method="post">
    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">
                Ferdig utdannet år: 
            </div>
            <div class="fieldInput">
                <select name="graduateYear">
                    <option value="1990">2015</option>
                </select>
            </div>
        </div>

        <div class="inputGoup">
            <div class="fieldDefinition">
                Studieretning: 
            </div>
            <div class="fieldInput">
                <select name="specialization">
                    <option value="-1">(Avbrutt studie)</option>
                    <option value="0" selected="selected">(Ikke valgt)</option>
                    <option value="2">Petroleumsfag</option>
                    <option value="3">Geomatikk</option>
                    <option value="4">Konstruksjonsteknikk</option>
                    <option value="5">Marin teknikk</option>
                    <option value="7">Produkt & prosess</option>    
                </select>
            </div>
        </div>

        <div class="inputGoup">
            <div class="fieldDefinition">
                Fødselsdato:
            </div>
        </div>

        <div class="inputGoup">
            <div class="fieldInput">
                <select name="bornDay">
                    <option value="11">23</option>
                </select>
                <select name="bornMonth">
                    <option value="1">12</option>
                </select>
                <select name="bornYear">
                    <option value="1990">1990</option>
                </select>
            </div>
        </div>

        <div class="fieldExplanation">
            La stå tom om du ikke vil bli plaget med gratulasjoner på bursdagen din.
        </div>
    </div>

    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Privat e-postadresse:</div>
            <div class="fieldInput"><input value="" size="30" name="email" type="email"></div>
        </div>

        <div class="inputGoup">
            <div class="fieldDefinition">Jobbrelatert e-postadresse:</div>
            <div class="fieldInput"><input value="" size="30" name="work" type="email"></div>
        </div>

        <div class="fieldExplanation">
            E-posten du skriver inn her er bare synlig for innloggede hybrider.
            Ved å fylle den inn, sikrer du at andre hybrider kan ta kontakt med
            deg etter NTNU. Skriv derfor <strong>ikke</strong> inn NTNU-adressen
            (brukernavn@stud.ntnu.no) - denne mister du når du er ferdig på NTNU!
        </div>
    </div>

    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Kortnummer:</div>
            <div class="fieldInput"><input value="" size="30" name="cardnr" type="text"></div>

            <div class="fieldExplanation">
                For eksempel "NTNU123456" (uten ""). Brukes for å komme inn på Hybridas bedriftspresentasjoner. <a href="/bilder/kort.jpg" target="_blank">Hvor finner jeg kortnummeret?</a>
            </div>
        </div>
    </div>

    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Om meg:</div>

            <div class="fieldInput"><textarea cols="45" rows="6" wrap="soft" name="tekst"></textarea></div>

            <div class="fieldExplanation">
                I infotekst-feltet kan du legge til en beskrivelse av deg selv, hjemmeside og eventuelt
                mobilnummer. Denne informasjonen vil kun hybrider kunne se.
            </div>
        </div>
    </div>
    
    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Jobber i bedrift:</div>
            <div class="fieldInput"><input value="" size="30" name="company" type="text"></div>
            <div class="fieldExplanation">
                Navnet på bedriften du har blitt ansatt i. Hvis bedriften ikke finnes i databasen,
                si ifra i stillingsbeskrivelsen, så blir bedriften blir lagt til av Bedkom.
            </div>
        </div>

        <div class="inputGoup">
            <div class="fieldDefinition">Stillingsbeskrivelse:</div>
            <div class="fieldInput"><textarea cols="45" rows="6" wrap="soft" name="workDescription"></textarea></div>
            <div class="fieldExplanation">
                Hva jobber du med? For eksempel offshore konstruksjoner eller NX.
            </div>
        </div>
            
        <div class="inputGoup">
            <div class="fieldDefinition">Arbeidssted</div>
            <div class="fieldInput"><input value="" size="30" name="workPlace" type="text"></div>
            <div class="fieldExplanation">
                Hvor du jobber (for eksempel Oslo).
            </div>
        </div>

        <div class="fieldExplanation">
            Statistikken fra denne undersølsen publiseres i <a href="#">Aluminilisten</a>.
        </div>

    </div>

    <div class="formSection">
        <div class="inputGoup">
            <div class="fieldDefinition">Last opp bilde:</div>
            
            <div class="fieldInput">
                <input type="file" name="user_image">
            </div>
            
            <div class="fieldExplanation">
                Du må kanskje oppdatere siden for at det nye bildet skal vises.
            </div>
        </div>
    </div>
    
</form>

<!--
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
        <em style="font-size: 80%">Du må kanskje oppdatere siden for at det nye bildet skal vises</em>
        <br/><br/><input value="Last opp" name="new_user_image" type="submit">    
    </form>
</div>

-->