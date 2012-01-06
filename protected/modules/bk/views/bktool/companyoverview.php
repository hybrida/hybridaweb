<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Bedriftsoversikt</h2>

<p>Bedriftsoversikten er oversikten over alle bedrifter som <?= $this->title ?> er, og har vært, i kontakt med.</p>

<p>
    <table id="BK-companyoverview-supporttable">
        <tr>
            <th>Statistikk:</th>
            <th>Valg:</th>
        </tr>
        <tr>
            <td>
                <div id="BK-companyoverview-container">
                <table id="BK-companyoverview-statisticstable">
                    
                    <? $sum = 0; ?>
                    
                     <? foreach($statistics as $stat) : ?>
           
                        <? switch ($stat['status']){
                                case "Aktuell senere": ?>
                                    <tr bgcolor="yellow">
                        <?          break;
                                case "Blir kontaktet": ?>
                                    <tr bgcolor="#00CC00">
                        <?          break;
                                case "Ikke kontaktet": ?>
                                    <tr bgcolor='#FFFFFF'>
                        <?          break;
                                case "Uaktuell": ?>
                                    <tr bgcolor="#FF0033">
                        <?          break;
                                default: ?>
                                    <tr bgcolor='#FFFFFF'>
                        <? } ?>

                            <td><?= $stat['sum'] ?> <?= $stat['status'] ?></td>
                        </tr>
                        
                        <? $sum = $sum + $stat['sum']; ?>
                    <? endforeach ?>
                        
                    <tr><th><?= $sum ?> Bedrifter totalt</th></tr>
                </table>
                </div>
                
            </td>
            <td>
                <table id="BK-companyoverview-selectiontable">
                    <tr><td>Legg til bedrift</td></tr>
                    <tr><td>Legg til bedriftspresentasjon</td></tr>
                </table>
            </td>
        </tr>
    </table>
</p>

<p><h3>Bedrifter:</h3></p>

<div id="BK-companyoverview-container">
<p>
<div id="BK-companyoverview-maintablebox">

    <table id="BK-companyoverview-maintable">
        <tr>
            <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/companyoverview'>Bedrift</th>
            <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/companyoverview'>Status</th>
            <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/companyoverview'>Kontaktet av</th>
            <th><a href='<?= Yii::app()->baseUrl ?>/<?= $this->module->id ?>/bktool/companyoverview'>Dato lagt til</th>
        </tr>
      
        <? foreach($companies as $company) : ?>
           
            <? switch ($company['status']){
                    case "Aktuell senere": ?>
                        <tr bgcolor="yellow">
            <?          break;
                    case "Blir kontaktet": ?>
                        <tr bgcolor="#00CC00">
            <?          break;
                    case "Ikke kontaktet": ?>
                        <tr bgcolor='#FFFFFF'>
            <?          break;
                    case "Uaktuell": ?>
                        <tr bgcolor="#FF0033">
            <?          break;
                    default: ?>
                        <tr bgcolor='#FFFFFF'>
            <? } ?>
                
                <td><a href="<?= Yii::app()->baseUrl ?>/company/<?= $company['companyID'] ?>"><?= $company['companyName'] ?></a></td>
                <td><?= $company['status'] ?></td> 
                <td><a href='/profile/<?= $company['id'] ?>'><?= $company['firstName'] ?> <?= $company['middleName'] ?> <?= $company['lastName'] ?></a></td>
                <td><?= $company['dateAdded'] ?></td>
            </tr>

        <? endforeach ?>
    </table>

</div>
</p>
</div>