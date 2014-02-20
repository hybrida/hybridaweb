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
				<?= $this->clips['sidebar'] ?>
				<? $this->widget('IKTRingenAdvertisement') ?>

				<div class="g-barTitle">Sponsorer</div>
				<div class="g-barText">
					<a href="http://www.sit.no">
						<img src="/images/sit.png" />
					</a>
				</div>
			</div>
<?php $this->endContent(); ?>