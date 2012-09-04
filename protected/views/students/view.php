<? $this->pageTitle = "Klasseliste " . $graduationYear ?>

<?
$this->layout = "//layouts/doubleColumn";
$this->beginClip('sidebar'); ?>
    <ul>
        <li><b><?= CHtml::link('Alumnioversikt', array('graduate/index')) ?></b></li>
    </ul>
<?
$this->endClip();
?>

<div class="memberlists">
<div id='g-groupNavigation'>
	<? for ($i = 1; $i <= 5; $i++): ?>
		<?=	CHtml::link("$i. klasse", array(
			"students/view",
			'id' => YearConverter::classYearToGraduationYear($i)), array(
			'class' => 'g-groupNavigationItem')) ?>
	<? endfor ?>

</div>


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

				<td><a href='<?= Yii::app()->baseURL ?>/#'><?= $user['name'] ?></a></td>
			</tr>
		</div>
	<? endforeach; ?>
</table>
</div>