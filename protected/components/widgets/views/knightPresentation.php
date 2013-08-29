 <div id="widget-knightPresentation">
     

    <?foreach ($models as $model) :?>
        <div class="knight g-clearfix">
            <div class="grantYear"><?= $model->grantYear ?></div>
            <div class="name"><?= $model->firstName . " " . $model->lastName ?></div>
            <div class="reason"><b>Avgangsår:</b> <?=$model->graduationYear ?></div>
            <div class="reason"><b>Begrunnelse:</b> <?= $model->reason ?></div>
        </div>
    <?endforeach;?>

    <script type="text/javascript">

        var knights = $("#widget-knightPresentation").find(".knight");
        knights.find(".name").click(function(e) {
           var parent = $(this).parent();
           var reason = parent.find(".reason").toggle();
        });

    </script>

</div>
