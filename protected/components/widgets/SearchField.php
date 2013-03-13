<?php

class SearchField extends CWidget {
	public function run() {
		if (user()->isGuest) return;
		?><div class="layout-search">
			<input type="text" id="searchField" placeholder="Søk"/>
		</div><?
	}
}
