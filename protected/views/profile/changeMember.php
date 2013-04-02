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

		span.member, span.notmember {
			font-size: 20px;
		}
	</style>


	<? if ($user): ?>
		<h1>Endre medlemsskap</h1>
		<form method="post">
			<input type="hidden" value="<?= $user->id ?>" />
			<div class="name">
				<strong>Navn: </strong> <?= $user->fullName ?> <br/>
				<strong>Trinn: </strong> <?= $user->classYear ?>. Klasse <br/>
				<strong>Medlem: </strong>
				<? if ($user->member == 'true'): ?>
					<span class="member">Medlem</span>
				<? else: ?>
					<span class="notmember">Ikke Medlem</span>
				<? endif ?>
			</div>
			<div class="message">
				<?= $message ?>
			</div>
			<br/>
			<input class="member" type="submit" name="isMember" value="Medlem"/>
			<input class="notmember" type="submit" name="isNotMember" value="Ikke Medlem"/>
		</form>
	<? endif ?>

	<script>
		require(['autocomplete/user'], function(autocompleteUser){
			var addAutoComplete = autocompleteUser.addUserAutocomplete
			addAutoComplete(".profileChangeMember input.username");
		});
	</script>

	<h1>Søk</h1>



	<form method="get" class="g-form" name="search">
		<div class="row">
			<label>Brukernavn</label>
			<input class="username" autofocus type="text" placeholder="Brukernavn" name="username"/>
			<input type="submit" class="g-button"/>
		</div>
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