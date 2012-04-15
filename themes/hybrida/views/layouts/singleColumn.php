<?php $this->beginContent('//layouts/main'); ?>
            <div class="content">	
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('application.components.widgets.BreadCrumb', array(
                        'links' => $this->breadcrumbs,
						'options' => $this->breadcrumbOptions,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>
                <?= $content ?>
            </div>
<?php $this->endContent(); ?>