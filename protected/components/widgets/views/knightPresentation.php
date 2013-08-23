
    <div id="knightPresentation_wrapper">
        <div id="knightPresentation_content">
                <div id="knightPresentation_content-left">Navn</div>
                <div id="knightPresentation_content-right">Tildelingsår</div>
                <div id="knightPresentation_content-main">Avgangsår</div>
         </div>
    </div>

    
<?foreach ($models as $model) :?>


       
        <div id="knightPresentation_wrapper">
            <div id="knightPresentation_content">
                    <div id="knightPresentation_content-left"><a href="javascript:toogle('knightPresentation_footer');"><?=$model->firstName;?> <?=$model->lastName;?></a></div>
                    <div id="knightPresentation_content-main"><?=$model->graduationYear;?></div>
                    <div id="knightPresentation_content-right"><?=$model->grantYear;?></div>
            </div>
            
            <div style="none" id="knightPresentation_footer" class="knightPresentation_hidden"><?=$model->reason?></div>
        </div>

    <script type="text/javascript">
        function toggle(element) {
            document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
        }
    </script>


<?endforeach;?>



    
