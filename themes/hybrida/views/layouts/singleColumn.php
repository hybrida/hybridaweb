<?php $this->beginContent('//layouts/main'); ?>
            <div class="content">	
                <?php if (isset($this->breadcrumbs) && isset($this->breadcrumbOptions)): ?>
                    <?php
                    $this->widget('application.components.widgets.BreadCrumb', array(
                        'links' => $this->breadcrumbs,
						'options' => $this->breadcrumbOptions,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>
                <?= $content ?>
            </div>
			<div class="rightBar">
			
            </div>
<?php $this->endContent(); ?>