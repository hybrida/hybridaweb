<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Rediger alumnistudent</h2>

<p>
    <h2>(Navn)</h2>
</p>

<p>
<div id="BK-add-container">
    <form name="editgraduateform" method="post" action="">
        <table>
            <tr>
                <th>Alternativ-Email</th>
                <th>
                    <input name="altemail" type="text" class="textfield" value='' maxlength="255" /> Characters (255)
                </th>
            </tr>
            <tr>
                <th>Spesialisering</th>
                <th>
                    
                </th>
            </tr>
            <tr>
                <th>Bedrift</br>(Man kan kun velge bedrifter som allerede finnes i databasen)</th>
                <th>
                    <input type='text' name='workcompany' value='<?php /* echo $_SESSION['subgroup']; */?>' maxlength="255" onkeyup="ajax_showOptions(this, 'getCompanies', event)"
                    <?php /*
			if($_SESSION['POSTEDsubgroup'] != $_SESSION['subgroup'] || $_SESSION['subgroup'] == 'Bedriften finnes ikke i databasen'){
                            echo "style='color: #FF0000;'";
                    ?> onclick="this.value=''; this.style.color = '#000000';" <?php
                    } */
                    ?>/>  Characters (255)
		</th>
            </tr>
            <tr>
                <th>Stillingsbeskrivelse</th>
                <th>
                    
                </th>
            </tr>
            <tr>
                <th>Arbeidssted</th>
                <th>
                    <input name="workplace" type="text" class="textfield" value='' maxlength="255" /> Characters (255)
                </th>
            </tr>
            <tr>
                <th>Uteksamineringsår</th>
                <th>
                    
                </th>
            </tr>
        </table>
                
        <p align="center" >
            <input type="submit" name="Submit" value="Utfør endringer" />
	</p>
    </form>
</div>