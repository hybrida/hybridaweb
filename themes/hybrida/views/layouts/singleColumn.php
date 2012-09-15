<?php $this->beginContent('//layouts/main'); ?>
            <div class="layout-content">	
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
			<div class="layout-rightBar">
				<? $this->widget('IKTRingenAdvertisement') ?>
				
				<div class="g-barTitle"></div>
				<div class="g-barText">
					<img src="/images/sit.png" />
				</div>
            </div>
<?php $this->endContent(); ?>