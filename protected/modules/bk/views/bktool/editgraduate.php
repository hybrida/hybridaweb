<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Rediger alumnistudent</h2>

<p>
<h2>
    <? foreach($graduateInfo as $info) : ?>
        <img src='<?= Yii::app()->baseUrl ?>/image/view/id/<?= $info['imageId'] ?>/size/3'/>
        <a href='/profile/<?= $info['id'] ?>'><?= $info['firstName'] ?> <?= $info['middleName'] ?> <?= $info['lastName'] ?></a>
    <? endforeach ?>
</h2>
</p>

<p>
<div id="BK-add-container">
    <form name="editgraduateform" method="post" action="editgraduateform">
        <table>
            <tr>
                <th>Alternativ-Email</th>
                <th>
                    <? foreach($graduateInfo as $info) : ?>
                        <input name="altemail" type="text" class="textfield" value='<?= $info['altEmail'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
                </th>
            </tr>
            <tr>
                <th>Spesialisering</th>
                <th>
                    <? foreach($specializationNamesSum as $info) : ?>
                        <select name="status" size="<?= $info['sum'] ?>">
                            
                            <? foreach($specializationNames as $name) : ?>
                                <option value="<?= $name['id'] ?>"
                                        
                                    <? foreach($graduateInfo as $info) : ?>
                                        <?= ($name['name'] == $info['name'] ? "selected" : ""); ?>
                                    <? endforeach ?>
                                        
                                ><?= $name['name'] ?></option>
                            <? endforeach ?> 
                                
                    <? endforeach ?>
                        </select>
                </th>
            </tr>
            <tr>
                <th>Bedrift</br>(Man kan kun velge bedrifter som allerede finnes i databasen)</th>
                <th>
                    <? foreach($graduateInfo as $info) : ?>
                        <input type='text' name='workcompany' value='<?= $info['companyName'] ?>' maxlength="255" onkeyup="ajax_showOptions(this, 'getCompanies', event)"
                        <?php /*
                            if($_SESSION['POSTEDsubgroup'] != $_SESSION['subgroup'] || $_SESSION['subgroup'] == 'Bedriften finnes ikke i databasen'){
                                echo "style='color: #FF0000;'";
                        ?> onclick="this.value=''; this.style.color = '#000000';" <?php
                        } */
                        ?>/>  Characters (255)
                    <? endforeach ?>
		</th>
            </tr>
            <tr>
                <th>Stillingsbeskrivelse</th>
                <th>
                    <? foreach($graduateInfo as $info) : ?>
                        <textarea name='workdescription' ><?= $info['workDescription'] ?><? /*
                            if($_SESSION['addedcomment'] == '' || $_SESSION['addedcomment'] == 'Kommentar mangler'){
                                echo $_SESSION['addedcomment'];
                            } */ 
                        ?></textarea>
                    <? endforeach ?>
                </th>
            </tr>
            <tr>
                <th>Arbeidssted</th>
                <th>
                    <? foreach($graduateInfo as $info) : ?>
                        <input name="workplace" type="text" class="textfield" value='<?= $info['workPlace'] ?>' maxlength="255" /> Characters (255)
                    <? endforeach ?>
                </th>
            </tr>
            <tr>
                <th>Uteksamineringsår</th>
                <th>
                    <select name="status" size="10"> 
                        <? foreach($graduationYears as $year) : ?>
                            <option value="<?= $year['graduationYear'] ?>" align="center"
                                    
                                <? foreach($graduateInfo as $info) : ?>
                                    <?= ($year['graduationYear'] == $info['graduationYear'] ? "selected" : ""); ?>

                                <? endforeach ?>
                                            
                            ><?= $year['graduationYear'] ?></option>
                        <? endforeach ?>
                    </select>                    
                </th>
            </tr>
        </table>
                
        <p align="center" >
            <input type="submit" name="Submit" value="Utfør endringer" />
	</p>
    </form>
</div>