<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Bedriftsoversikt</h2>

<p>Bedriftsoversikten er oversikten over alle bedrifter som <?= $this->title ?> er, og har vært, i kontakt med.</p>

<p>
    <table id="BK-companyoverview-supporttable">
        <tr>
            <th id="BK-companyoverview-supporttable-header">Statistikk:</th>
            <th id="BK-companyoverview-supporttable-header">Valg:</th>
        </tr>
        <tr>
            <td id="BK-companyoverview-supporttable-element">
                <table id="BK-companyoverview-statisticstable">
                    
                    <? $sum = 0; ?>
                    
                    <? foreach($statistics as $stat) : ?>
                    <tr>
                        <td id="BK-companyoverview-numbercolumn"><?= $stat['sum'] ?></td>
           
                        <? switch ($stat['status']){
                                case "Aktuell senere": ?>
                                    <td id ="BK-companyoverview-aktuell-senere">
                        <?          break;
                                case "Blir kontaktet": ?>
                                    <td id="BK-companyoverview-blir-kontaktet">
                        <?          break;
                                case "Ikke kontaktet": ?>
                                    <td id="BK-companyoverview-ikke-kontaktet">
                        <?          break;
                                case "Uaktuell": ?>
                                    <td id="BK-companyoverview-uaktuell">
                        <?          break;
                                default: ?>
                                    <td>
                        <? } ?><?= $stat['status'] ?></td>
                    </tr>
                        
                        <? $sum = $sum + $stat['sum']; ?>
                    <? endforeach ?>
                        
                    <tr>
                        <th id="BK-companyoverview-numbercolumn"><?= $sum ?></th>
                        <th id="BK-companyoverview-totaltext">Bedrifter totalt</th>
                    </tr>
                </table>
                
            </td>
            <td id="BK-companyoverview-supporttable-element">
                <ul>
                    <li><?=CHtml::link('Legg til bedrift', array('addcompany'))?></li>
                </ul>
            </td>
        </tr>
    </table>
</p>

<p><h2>Bedrifter:</h2></p>

<p>
    <table id="BK-companyoverview-maintable">
        <tr>
            <th><?=CHtml::link('Bedrift', array('companyoverview?orderby=companyName&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Status', array('companyoverview?orderby=status&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Kontaktet av', array('companyoverview?orderby=firstName&order='.$_SESSION['order'])) ?></th>
            <th><?=CHtml::link('Sist oppdatert', array('companyoverview?orderby=dateUpdated&order='.$_SESSION['order'])) ?></th>
        </tr>
      
        <? foreach($companies as $company) : ?>
            <tr> 
                <td><?=CHtml::link($company['companyName'], array('company?id='.$company['companyID']))?></td>
                    <? switch ($company['status']){
                            case "Aktuell senere": ?>
                                <td id="BK-companyoverview-aktuell-senere">
                    <?          break;
                            case "Blir kontaktet": ?>
                                <td id="BK-companyoverview-blir-kontaktet">
                    <?          break;
                            case "Ikke kontaktet": ?>
                                <td id="BK-companyoverview-ikke-kontaktet">
                    <?          break;
                            case "Uaktuell": ?>
                                <td id="BK-companyoverview-uaktuell">
                    <?          break;
                            default: ?>
                                <td>
                    <? } ?>
                        <?= $company['status'] ?>
                    </td> 
                <td><a href='/profil/<?= $company['username'] ?>'><?= $company['firstName'] ?> <?= $company['middleName'] ?> <?= $company['lastName'] ?></a></td>
                <td><?= $company['dateUpdated'] ?></td>
            </tr>

        <? endforeach ?>
    </table>
</p>