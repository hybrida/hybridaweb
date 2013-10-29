<? $this->pageTitle = "Klasseliste " . $graduationYear ?>

<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); ?>
<div class="g-barTitle">Avgangsår</div>
<div class="g-sidebarNav">
	<ul>
		<? for ($i = 1; $i <= 5; $i++): ?>
			<li>
				<?=	CHtml::link("$i. klasse", array(
					"students/view",
					'id' => YearConverter::classYearToGraduationYear($i)), array(
					'class' => 'g-groupNavigationItem')) ?>
			</li>
		<? endfor ?>
		<li>
			<?= CHtml::link('Alumnioversikt', array('graduate/index')) ?>
		</li>
	</ul>
</div>
<?
$this->endClip();
?>

<div class="memberlists">


<table class="g-membertable">
	<tr>
		<th></th><th>Navn</th><th>Medlemskap</th><th>Spesialisering</th>
	</tr>
	<? $odd = false ?>
	<? foreach ($users as $user) : ?>
		<? $odd = !$odd ?>
		<div class="<?= $odd ? "odd" : "like" ?>" >
			<tr>
				<td class="imageCell">
					<?= Image::profileTag($user['imageId'], 'mini') ?>
				</td>
				<td class="nameCell"><?= CHtml::link($user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'], array('/profile/info', 'username' => $user['username'])) ?></a></td>

				<td class="isMemberCell">
					<? if ($user['member'] == 'true') { ?>
						Medlem
					<? } else { ?>
						Ikke medlem
					<? } ?>
				</td>

				<td><a href='<?= Yii::app()->baseURL ?>/artikler/<?=$user['article_id']?>/<?=$user['name']?>'><?= $user['name'] ?></a></td>
			</tr>
		</div>
	<? endforeach; ?>
</table>
</div>