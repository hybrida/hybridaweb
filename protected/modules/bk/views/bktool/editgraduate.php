<?php $this->renderPartial("_menu", array()); ?>

<h1>
    <?= $this->title ?>
</h1>

<h2>Rediger alumnistudent</h2>

<p>
<div id="BK-add-container">
    <form name="editgraduateform" method="post" action="">
        <table>
            <tr>
                <th>Alternativ-Email</th>
                <th>
                    
                </th>
            </tr>
            <tr>
                <th>Spesialisering</th>
                <th>
                    
                </th>
            </tr>
            <tr>
                <th>Bedrift</th>
                <th>
                    
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