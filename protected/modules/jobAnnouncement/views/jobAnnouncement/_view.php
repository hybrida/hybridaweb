<div class="view g-clearfix">
	<div class="left">
		<a href="<?= $this->createUrl('view', array('id' => $data->id)) ?>">
			<img src="/images/company_logo_default.png"
				 alt="default company logo" />
		</a>
	</div>

	<div class="right">

		<div class="title">
			<strong>Tittel:</strong>
			<?= CHtml::link($data->title, array('view', 'id' => $data->id)) ?>
		</div>

		<div class="company">
			<strong>Bedrift:</strong>
			<?= $data->company->companyName ?>
		</div>

		<div class="deadline">
			<strong>Søknandsfrist:</strong>
			<?= Html::dateToString($data->deadline, 'mediumlong') ?>
		</div>

	</div>
</div>