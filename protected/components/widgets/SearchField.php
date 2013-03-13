<?php

class SearchField extends CWidget {
	public function run() {
		if (user()->isGuest) return;
		?><form class="layout-search">
			<input type="text" id="searchField" placeholder="Søk"/>
		</form><?
	}
}
