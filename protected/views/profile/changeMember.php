<div class="profileChangeMember">

	<style>
		.name {
			font-size: 30px;
		}
		.member, .notmember {
			color: white;
			font-weight: bold;
			border-radius: 2px;
			border: 0;
			padding: 0.4em;
			cursor: pointer;
		}

		.member {
			background-color: green;

		}

		.notmember {
			background-color: red;
		}
	</style>

	<?if ($user):?>
	<h1>Endre medlemsskap</h1>
	<form method="post">
		<input type="hidden" value="<?= $user->id ?>" />
		<div class="name">
			<strong>Navn: </strong> <?= $user->fullName ?> <br/>
			<strong>Trinn: </strong> <?= $user->classYear ?>. Klasse <br/>
		</div>
		<div class="message">
			<?= $message?>
		</div>
		<input class="member" type="submit" name="isMember" value="Medlem"/>
		<input class="notmember" type="submit" name="isNotMember" value="Ikke Medlem"/>
	</form>
	<? endif?>
	
	<h1>Søk</h1>
	<form method="get">
		<input type="text" placeholder="Fornavn" name="firstName"/>
		<input type="text" placeholder="Etternavn" name="lastName" />
		<input type="submit"/>
	</form>
	
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div>