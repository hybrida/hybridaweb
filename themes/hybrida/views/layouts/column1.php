<?php $this->beginContent('//layouts/main'); ?>
            <div class="content">	
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>
                <?= $content ?>
            </div>
<?php $this->endContent(); ?>