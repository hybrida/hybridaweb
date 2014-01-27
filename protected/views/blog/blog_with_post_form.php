

<?php
/* @var $this BlogEntryController */
/* @var $model BlogEntry */
/* @var $form CActiveForm */
?>
 
<div class="g-form">
 
<?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'blog-entry-NewBlogEntry-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
)); ?>
 
        <div class="row">
                <?php echo $form->labelEx($formdata,'title'); ?>
                <?php echo $form->textField($formdata,'title'); ?>
                <?php echo $form->error($formdata,'title'); ?>
        </div>
 
 
        <div class="row">
                <?php echo $form->labelEx($formdata,'content'); ?>
                <?php echo $form->richTextArea($formdata,'content'); ?>
                <?php echo $form->error($formdata,'content'); ?>
        </div>
 
 
        <div class="row buttons">
                <?php echo CHtml::submitButton('Submit'); ?>
        </div>
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->

<script>
    window.onload=function() {
        window.blog_elements = document.getElementsByClassName("blog_entry");
        window.warning_elements = document.getElementsByClassName("warning");
        for (var i = 0; i<blog_elements.length; i++) {
            window.setTimeout(fade,i*100,false,blog_elements.item(i),1);
        }
        for (var j = 0; j<warning_elements.length; j++) {
            window.setTimeout(fade,j*100,true,warning_elements.item(j),1);
        }
    }

    function fade(sidescroll,obj,telle) {
        telle -= 0.05;
        obj.style.opacity = 1-telle*telle;
        if (sidescroll==false) {
            obj.style.top = telle*telle*25+"px";
        } else {
            obj.style.right = telle*telle*25+"px";
        }
        if (telle > 0) {
            window.setTimeout(fade,10,sidescroll,obj,telle);
        } else if (sidescroll==false) {
            obj.style.opacity = 1;
            obj.style.top = "0px";
        } else {
            obj.style.opacity = 1;
            obj.style.right = "0px";
        }
    }
</script>

<?php 
    for ($i = 0; $i < count($data); ++$i) {
        $row = $data[$i];
        echo "<div class=\"blog_entry\">";
        echo "<div class=\"title\">" . $row["title"] . "</div>";
        echo "<hr class=\"underline\" />";
        echo "<div class=\"content\">" . $row["content"] . "</div>";
        echo "<div class=\"dateline\"> Av " . $row["uid"] . ", " . $row["time"] . "</div>";
        echo "</div>";
    }
?>